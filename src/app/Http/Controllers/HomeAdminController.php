<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Tag;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeAdminController extends Controller
{
    public function getProductInventory(Request $request)
    {
        $product_id = $request->input('product_id');
        $size = $request->input('size');
        $color = $request->input('color');

        $inventory = Inventory::where('product_id', $product_id)
            ->where('size', $size)
            ->where('color', $color)
            ->first();

        if ($inventory) {
            return response()->json(['quantity' => $inventory->quantity]);
        } else {
            return response()->json(['quantity' => 0]);
        }
    }


    public function index()
    {
        // Lấy danh sách slider
        $sliders = Slider::latest()->get();

        // Lấy danh sách các danh mục cấp 1
        $categorys = Category::where('parent_id', 0)->get();

        // Lấy danh sách 10 sản phẩm mới nhất
        $products = Product::latest()->take(10)->get();

        // Lấy danh sách 12 sản phẩm được xem nhiều nhất
        $productsFeatures = Product::orderBy('views_count', 'desc')->take(12)->get();

        // Lấy danh sách 6 danh mục cấp 1 đầu tiên
        $categorysLimit = Category::where('parent_id', 0)->take(6)->get();

        // Truy vấn và tính toán số lượng sản phẩm đã bán cho mỗi product_id
        $productsSold = DB::table('order_details')
            ->select('product_id', DB::raw('SUM(product_sales_quantity) as total_sold'))
            ->groupBy('product_id');

        // Lấy danh sách 12 sản phẩm được bán chạy nhất
        $productsSelling = Product::leftJoinSub($productsSold, 'productsSold', function ($join) {
            $join->on('products.id', '=', 'productsSold.product_id');
        })
            ->orderByDesc('productsSold.total_sold') // Sắp xếp theo số lượng sản phẩm đã bán từ cao đến thấp
            ->take(12)
            ->get();


        // Lấy số lượng sản phẩm đã bán cho mỗi sản phẩm cụ thể và lưu vào một mảng kết hợp
        $productSalesQuantity = [];
        foreach ($productsSelling as $product) {
            $productSalesQuantity[$product->id] = $product->total_sold;
        }
        //dd($productSalesQuantity);
        // Trả về view home và truyền các biến dữ liệu cần thiết
        return view("home.home", compact("sliders", "categorys", "products", "productsSelling", "categorysLimit", "productsFeatures", "productSalesQuantity"));
    }
    // chi tiết sản phẩm
    public function detail($slug)
    {
        $product = Product::with('inventorys')->where("slug", $slug)->firstOrFail();


        // Tăng lượt xem lên 1
        $product->increment('views_count');

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->get();

        return view('home.detail', compact('product', 'related'));
    }
    public function getInventoryId(Request $request)
    {
        // Lấy các giá trị từ request
        $productId = $request->input('product_id');
        $sizeId = $request->input('size_id');
        $colorId = $request->input('color_id');

        // Tìm kiếm inventory_id từ cơ sở dữ liệu
        $inventory = Inventory::where('product_id', $productId)
            ->where('size', $sizeId)
            ->where('color', $colorId)
            ->first();

        if ($inventory) {
            // Trả về inventory_id nếu tìm thấy
            return response()->json(['inventory_id' => $inventory->inventory_id]);
        } else {
            // Xử lý nếu không tìm thấy inventory_id
            return response()->json(['inventory_id' => null]);
        }
    }
    // tìm kiếm
    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;
        $productsSelling = Product::latest('views_count', 'desc')->take(12)->get();
        $search_product = DB::table('products')->where('name', 'like', '%' . $keywords . '%')->get();
        return view("home.search", compact("productsSelling"))->with('search_product', $search_product);
    }


    public function product_all(Request $request)
    {
        // Truy vấn danh sách các danh mục sản phẩm
        $categories = Category::where('parent_id', 0)->get();

        // Truy vấn dữ liệu sản phẩm
        $query = Product::query();

        // Lọc theo danh mục sản phẩm được chọn (nếu có)
        if ($request->has('selected_categories')) {
            $selectedCategories = $request->input('selected_categories');
            $query->whereIn('category_id', $selectedCategories);
        }

        // Xử lý lọc theo giá
        if ($request->has('price_range') && !in_array('0-100000000', $request->price_range)) {
            $priceRange = $request->price_range;
            $query->where(function ($query) use ($priceRange) {
                foreach ($priceRange as $range) {
                    [$minPrice, $maxPrice] = explode('-', $range);
                    $query->orWhereRaw('CAST(sale_price AS DECIMAL(10,2)) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
                }
            });
        }

        // Xử lý lọc theo tag sản phẩm
        if ($request->has('product_tags')) {
            $tagIds = $request->product_tags;
            $query->whereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('tags.id', $tagIds);
            });
        }

        // Truy vấn sản phẩm theo các điều kiện lọc và phân trang
        $products = $query->latest()->paginate(100);
        $tags = Tag::all();

        // Trả về view với biến $products, $tags và $categories
        return view('home.product_all', compact('products', 'tags', 'categories', 'request'));
    }

    public function yeu_thich()
    {
        return view('home.yeu_thich');
    }

    public function lien_he()
    {
        return view('home.lien_he');
    }

    public function blog()
    {
        return view('home.blog');
    }
    public function about()
    {
        return view('home.about');
    }
}
