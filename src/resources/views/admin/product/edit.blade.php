@extends('layouts.admin')

@section('title')
<title>Add product</title>
@endsection

@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('adminPublic/product/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Sửa', 'key' => 'sản phẩm'])
    <div class="content">
        <div class="container-fluid">
            <form class="row" action="{{ route('product.update', ['id' =>$product->id]) }}" method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div>
                        @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input name="name" type="text" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                        </div>

                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input name="price" type="text" class="form-control" placeholder="Nhập giá sản phẩm" value="{{ $product->price }}">
                        </div>

                        <div class="form-group">
                            <label>Giá sản phẩm sau khi giảm</label>
                            <input name="sale_price" type="text" class="form-control" placeholder="Nhập giá sản phẩm sau khi giảm" value="{{ $product->sale_price }}">
                        </div>

                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <input name="feature_image_path" type="file" class="form-control-file">
                            <div class="col-md-3 feature_image_container">
                                <div class="row">
                                    <img class="feature_image" src="{{ $product->feature_image_path }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ảnh chi tiết</label>
                            <input name="image_path[]" multiple type="file" class="form-control-file">
                            <div class="col-md-15 containe_image_detail">
                                <div class="row">
                                    @foreach ($product->productImage as $productImageItem)
                                    <div class="col-md-3">
                                        <img class="image_detail" src="{{ $productImageItem->image_path }}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Danh mục sản phẩm</label><br>
                            <select class="form-control select2_init" name="category_id">
                                <option value="">Chọn danh mục</option>
                                {!! $htmlOption !!}
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Size cho sản phẩm</label><br>
                            @php
                            $array = explode(",", $product->sizes);
                            @endphp
                            <select name="sizes[]" class="form-control select2_init" multiple="multiple">
                                <option value="XS" {{ in_array("XS", $array) ? "selected" : "" }}>XS</option>
                                <option value="S" {{ in_array("S", $array) ? "selected" : "" }}>S</option>
                                <option value="M" {{ in_array("M", $array) ? "selected" : "" }}>M</option>
                                <option value="L" {{ in_array("L", $array) ? "selected" : "" }}>L</option>
                                <option value="XL" {{ in_array("XL", $array) ? "selected" : "" }}>XL</option>
                                <option value="XXL" {{ in_array("XXL", $array) ? "selected" : "" }}>XXL</option>
                                <option value="XXXL" {{ in_array("XXXL", $array) ? "selected" : "" }}>XXXL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Màu sắc cho sản phẩm</label><br>
                            @php
                            $array1 = explode(",", $product->colors);
                            @endphp
                            <select name="colors[]" class="form-control select2_init" multiple="multiple">
                                <option value="Đen" {{ in_array("Đen", $array1) ? "selected" : "" }}>Đen</option>
                                <option value="Trắng" {{ in_array("Trắng", $array1) ? "selected" : "" }}>Trắng</option>
                                <option value="Xanh dương" {{ in_array("Xanh dương", $array1) ? "selected" : "" }}>Xanh dương</option>
                                <option value="Xanh lá cây" {{ in_array("Xanh lá cây", $array1) ? "selected" : "" }}>Xanh lá cây</option>
                                <option value="Đỏ" {{ in_array("Đỏ", $array1) ? "selected" : "" }}>Đỏ</option>
                                <option value="Vàng" {{ in_array("Vàng", $array1) ? "selected" : "" }}>Vàng</option>
                                <option value="Hồng" {{ in_array("Hồng", $array1) ? "selected" : "" }}>Hồng</option>
                                <option value="Tím" {{ in_array("Tím", $array1) ? "selected" : "" }}>Tím</option>
                                <option value="Nâu" {{ in_array("Nâu", $array1) ? "selected" : "" }}>Nâu</option>
                                <option value="Xám" {{ in_array("Xám", $array1) ? "selected" : "" }}>Xám</option>
                                <option value="Cam" {{ in_array("Cam", $array1) ? "selected" : "" }}>Cam</option>
                                <option value="Kem" {{ in_array("Kem", $array1) ? "selected" : "" }}>Kem</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea style="width: 500px; height: 200px" name="contents" class="form-control">{{ $product->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Link sản phẩm</label>
                            <input name="product_link" type="text" class="form-control" placeholder="Cập nhật link sản phẩm" value="{{ old('product_link') }}">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-up"></i>Gửi</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="inventory_list">
                        @foreach($product->inventorys as $item)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Size</label><br>
                                    <select name="size[]" class="form-control">
                                        <option value="XS" {{ $item->size === 'XS' ? "selected" : "" }}>XS</option>
                                        <option value="S" {{ $item->size === 'S' ? "selected" : "" }}>S</option>
                                        <option value="M" {{ $item->size === 'M' ? "selected" : "" }}>M</option>
                                        <option value="L" {{ $item->size === 'L' ? "selected" : "" }}>L</option>
                                        <option value="XL" {{ $item->size === 'XL' ? "selected" : "" }}>XL</option>
                                        <option value="XXL" {{ $item->size === 'XXL' ? "selected" : "" }}>XXL</option>
                                        <option value="XXXL" {{ $item->size === 'XXXL' ? "selected" : "" }}>XXXL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Màu sắc</label><br>
                                    <select name="color[]" class="form-control">
                                        <option value="Đen" {{ $item->color === 'Đen' ? "selected" : "" }}>Đen</option>
                                        <option value="Trắng" {{ $item->color === 'Trắng' ? "selected" : "" }}>Trắng</option>
                                        <option value="Xanh dương" {{ $item->color === 'Xanh dương' ? "selected" : "" }}>Xanh dương</option>
                                        <option value="Xanh lá cây" {{ $item->color === 'Xanh lá cây' ? "selected" : "" }}>Xanh lá cây</option>
                                        <option value="Đỏ" {{ $item->color === 'Đỏ' ? "selected" : "" }}>Đỏ</option>
                                        <option value="Vàng" {{ $item->color === 'Vàng' ? "selected" : "" }}>Vàng</option>
                                        <option value="Hồng" {{ $item->color === 'Hồng' ? "selected" : "" }}>Hồng</option>
                                        <option value="Tím" {{ $item->color === 'Tím' ? "selected" : "" }}>Tím</option>
                                        <option value="Nâu" {{ $item->color === 'Nâu' ? "selected" : "" }}>Nâu</option>
                                        <option value="Xám" {{ $item->color === 'Xám' ? "selected" : "" }}>Xám</option>
                                        <option value="Cam" {{ $item->color === 'Cam' ? "selected" : "" }}>Cam</option>
                                        <option value="Kem" {{ $item->color === 'Kem' ? "selected" : "" }}>Kem</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Số lượng</label><br>
                                    <input name="quantity[]" type="number" class="form-control" value="{{ $item->quantity }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label>Xoá</label><br>
                                <div onClick="deleteItem(this)" class="btn btn-danger"><i class="far fa-trash-alt"></i></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="addItemButton" class="btn btn-sm btn-outline-primary">Thêm hàng</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('adminPublic/product/add/add.js') }}"></script>
<script>
const inventoryList = document.querySelector('#inventory_list');
const addItemButton = document.querySelector('#addItemButton');

function deleteItem(_this) {
    _this.parentElement.parentElement.remove();
}

addItemButton.addEventListener('click', () => {
    const newItemHTML = `
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Size</label><br>
                    <select name="size[]" class="form-control select2_init">
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <option value="XXXL">XXXL</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Màu sắc</label><br>
                    <select name="color[]" class="form-control select2_init">
                        <option value="Đen">Đen</option>
                        <option value="Trắng">Trắng</option>
                        <option value="Xanh dương">Xanh dương</option>
                        <option value="Xanh lá cây">Xanh lá cây</option>
                        <option value="Đỏ">Đỏ</option>
                        <option value="Vàng">Vàng</option>
                        <option value="Hồng">Hồng</option>
                        <option value="Tím">Tím</option>
                        <option value="Nâu">Nâu</option>
                        <option value="Xám">Xám</option>
                        <option value="Cam">Cam</option>
                        <option value="Kem">Kem</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Số lượng</label><br>
                    <input name="quantity[]" type="number" class="form-control" value="0" min="0">
                </div>
            </div>
            <div class="col-md-1">
                <label>Xoá</label><br>
                <div onClick="deleteItem(this)" class="btn btn-danger"><i class="far fa-trash-alt"></i></div>
            </div>
        </div>
    `;
    inventoryList.insertAdjacentHTML('beforeend', newItemHTML);
});
</script>
@endsection
