<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function __construct(
        Category $category,
        Product $product,
        ProductImage $productImage,
        Tag $tag,
        ProductTag $productTag
    ) {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);
        return $htmlOption;
    }

    public function store(Request $request)
    {
        // dd($request->input());
        // DB::beginTransaction();
        $dataProductCreate = [
            'name'         => $request->name,
            'price'        => $request->price,
            'sale_price'   => $request->sale_price,
            'content'      => $request->contents,
            'user_id'      => auth()->id(),
            'category_id'  => $request->category_id,
            'product_link' => $request->product_link,
            'slug'         => Str::slug($request->name),
        ];
        if ($request->hasFile('feature_image_path')) {
            $file = $request->file('feature_image_path');

            $newImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/product/' . date('Y') . '/' . date('m'), $newImageName);

            $dataProductUpdate['feature_image_path'] = str_replace('public/', '/storage/', $path);
            $dataProductUpdate['feature_image_name'] = $file->getClientOriginalName();
        }

        $product = Product::create($dataProductCreate);

        if ($request->hasFile('image_path')) {
            foreach ($request->image_path as $fileItem) {
                $newImageName = pathinfo($fileItem->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $fileItem->getClientOriginalExtension();
                $path = $fileItem->storeAs('public/product-detail/' . date('Y') . '/' . date('m'), $newImageName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'image_name' => $newImageName,
                ]);

            }
        }

        $colors = $request->color;
        $sizes = $request->size;
        $quantities = $request->quantity;

        foreach ($colors as $index => $color) {
            Inventory::create([
                'product_id' => $product->id,
                'color'      => $color,
                'size'       => $sizes[$index],
                'quantity'   => $quantities[$index],
            ]);
        }

        //Insert tags for product
        // if (!empty($request->tags)) {

        //     foreach ($request->tags as $tagItem) {
        //         //insert to tags
        //         $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
        //         $tagIds[] = $tagInstance->id;
        //     }
        // }

        // $product->tags()->attach($tagIds);
        // DB::commit();
        return redirect()->route('product.index');
    }
    public function edit($id)
    {

        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }
    public function update(Request $request, $id)
    {
        // DB::beginTransaction();
        $dataProductUpdate = [
            'name'         => $request->name,
            'price'        => $request->price,
            'sale_price'   => $request->sale_price,
            'content'      => $request->contents,
            'user_id'      => auth()->id(),
            'category_id'  => $request->category_id,
            'product_link' => $request->product_link,
            'slug'         => Str::slug($request->name),

        ];
        if ($request->hasFile('feature_image_path')) {
            $file = $request->file('feature_image_path');
            
            $newImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/product/' . date('Y') . '/' . date('m'), $newImageName);

            $dataProductUpdate['feature_image_path'] = str_replace('public/', '/storage/', $path);
            $dataProductUpdate['feature_image_name'] = $file->getClientOriginalName();
        }

        $product = Product::where('id', $id)->first();
        $product->update($dataProductUpdate);

        //insert data to product_images
        if ($request->hasFile('image_path')) {
            $this->productImage->where('product_id', $id)->delete();
            foreach ($request->image_path as $fileItem) {
                $dataProductImageDetail = $this->storageTraitUploadMytiple($fileItem, 'product');
                $product->images()->create([
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image_name' => $dataProductImageDetail['file_name'],
                ]);
            }
        }

        Inventory::where('product_id', $product->id)->delete();

        $colors = $request->color;
        $sizes = $request->size;
        $quantities = $request->quantity;

        foreach ($colors as $index => $color) {
            Inventory::create([
                'product_id' => $product->id,
                'color'      => $color,
                'size'       => $sizes[$index],
                'quantity'   => $quantities[$index],
            ]);
        }

        return redirect()->route('product.index');
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->product);
    }
}
