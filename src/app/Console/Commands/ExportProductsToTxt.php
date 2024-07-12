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
        $txtContent = "THÔNG TIN CỬA HÀNG:
                                            Mani's Stylish Fashion là một cửa hàng thời trang cao cấp dành cho  nữ, nổi tiếng với các thiết kế hiện đại và phong cách đa dạng. Cửa hàng tập trung vào việc cung cấp các bộ sưu tập thời trang cập nhật theo xu hướng mới nhất, từ trang phục hàng ngày, đồ công sở đến các bộ cánh sang trọng cho những sự kiện đặc biệt. Cửa hàng cung cấp một loạt các sản phẩm thời trang từ áo, quần, váy, đầm đến các phụ kiện.
                                            Cửa hàng vừa bán trực tuyến và bán tại cửa hàng. Cửa hàng nhập ship toàn quốc bằng cả hai hình thức thanh toán đơn hàng: thanh toán khi nhận được hàng và thanh toán bằng ví Vnpay.
                                            ĐỊA CHỈ CỬA HÀNG:
                                            Tên cửa hàng: Manis Stylish Fashion
                                            126 Nguyễn Thiện Thành, Khóm 4, phường 5, tp.Trà Vinh
                                            Số điện thoại: 0382533858
                                            DANH MỤC SẢN PHẨM:
                                            -	Áo khoác  nữ
                                            -	Áo thun  nữ
                                            -	Áo sơ mi nữ
                                            -	Quần  nữ
                                            -	Đầm
                                            -	Đồ ngủ
                                            -	Chân váy
                                            -       Set
                                            -	Phụ kiện\n\n";
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
