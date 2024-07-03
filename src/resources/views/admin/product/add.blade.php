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
    @include('partials.content-header', ['name' => 'Thêm', 'key' => 'sản phẩm'])
    <div class="col-md-100">
        {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif --}}
</div>
<div class="content">
    <div class="container-fluid">
        <form class="row" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
            <div class="col-md-6">
                <div>
                    @csrf
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên sản phẩm" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input name="price" type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Nhập giá sản phẩm" value="{{ old('price') }}">
                    </div>
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Giá sản phẩm sau khi giảm</label>
                        <input name="sale_price" type="text" class="form-control @error('sale_price') is-invalid @enderror" placeholder="Nhập giá sản phẩm sau khi giảm" value="{{ old('sale_price') }}">
                    </div>
                    @error('sale_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <input name="feature_image_path" type="file" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Ảnh chi tiết</label>
                        <input name="image_path[]" multiple type="file" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Danh mục sản phẩm</label><br>
                        <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="">Chọn danh mục</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Mô tả sản phẩm</label>
                        <textarea style="width: 500px; height: 200px" name="contents" class="form-control @error('content') is-invalid @enderror">{{ old('contents') }}</textarea>
                    </div>
                    @error('contents')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Link sản phẩm</label>
                        <input name="product_link" type="text" class="form-control" placeholder="Cập nhật link sản phẩm" value="{{ old('product_link') }}">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-up"></i>Gửi</button>
                </div>
            </div>
            <div class="col-md-6">
                <div id="inventory_list">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Size</label><br>
                                <select name="size[]" class="form-control">
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
                                <select name="color[]" class="form-control">
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
