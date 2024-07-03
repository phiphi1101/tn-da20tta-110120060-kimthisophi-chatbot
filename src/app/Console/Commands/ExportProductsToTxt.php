<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExportProductsToTxt extends Command
{
    protected $signature = 'export:products-to-txt';
    protected $description = 'Export product data from MySQL to TXT file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Lấy dữ liệu từ bảng sản phẩm
        $products = DB::table('products')->get();

        // Tạo nội dung cho file TXT
        $txtContent = "Danh sách sản phẩm\n\n";

        foreach ($products as $product) {
            $txtContent .= "Tên sản phẩm: {$product->name}\n";
            $txtContent .= "Giá sản phẩm: {$product->price}\n";
            $txtContent .= "Giá sau giảm: {$product->sale_price}\n";
            // $txtContent .= "Danh mục sản phẩm: {$product->category_id}\n";
           // $txtContent .= "Size: {$product->sizes}\n";
           // $txtContent .= "Màu sắc: {$product->colors}\n";
            $txtContent .= "Mô tả: {$product->content}\n";
            $txtContent .= "Link sản phẩm: {$product->product_link}\n";
            $txtContent .= "\n";
        }

        // Đường dẫn lưu file TXT
        $filePath = 'public/product.txt';

        // Đảm bảo thư mục tồn tại và ghi nội dung vào file TXT
        Storage::put($filePath, $txtContent);

        $this->info("Dữ liệu đã được xuất vào " . storage_path('app/' . $filePath));
    }
}
