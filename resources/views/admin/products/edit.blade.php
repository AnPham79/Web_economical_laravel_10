@extends('admin.layouts.master')

@section('content')

    <div class="container" style="padding: 30px 0px">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="panel panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="fw-bold">Sửa sản phẩm</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('product.product-manager') }}" class="btn btn-success float-end">Quản lý sản phẩm</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('product.update-product', ['slug' => $data->product_slug_name]) }}" class="form-horizontal" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row my-2">
                            <label for="product_name" class="col-md-4 control-label fw-bold">Tên sản phẩm</label>
                            <div class="col-md-8">
                                <input type="text" id="product_name" placeholder="Nhập tên sản phẩm" name="product_name" class="form-control input-md border border-secondary px-2" value="{{ old('product_name', $data->product_name) }}"/>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="product_short_description" class="col-md-4 control-label fw-bold">Mô tả ngắn</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="product_short_description" placeholder="Nhập mô tả ngắn" name="product_short_description">{{ old('product_short_description', $data->product_short_description) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="product_description" class="col-md-4 control-label fw-bold">Mô tả</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="product_description" placeholder="Nhập mô tả" name="product_description">{{ old('product_description', $data->product_description) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="product_regular_price" class="col-md-4 control-label fw-bold">Giá sản phẩm</label>
                            <div class="col-md-8">
                                <input type="text" id="product_regular_price" placeholder="Nhập giá sản phẩm" class="form-control input-md border border-secondary px-2" name="product_regular_price" value="{{ old('product_regular_price', $data->product_regular_price) }}"/>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="product_percent_sale" class="col-md-4 control-label fw-bold">Phần trăm giảm giá</label>
                            <div class="col-md-8">
                                <input type="text" id="product_percent_sale" placeholder="Nhập phần trăm giảm giá" class="form-control input-md border border-secondary px-2" name="product_percent_sale" value="{{ old('product_percent_sale', $data->product_percent_sale) }}"/>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="product_quantity" class="col-md-4 control-label fw-bold">Số lượng sản phẩm</label>
                            <div class="col-md-8">
                                <input type="text" id="product_quantity" placeholder="Nhập số lượng sản phẩm" class="form-control input-md border border-secondary px-2" name="product_quantity" value="{{ old('product_quantity', $data->product_quantity) }}"/>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="product_SKU" class="col-md-4 control-label fw-bold">SKU</label>
                            <div class="col-md-8">
                                <input type="text" id="product_SKU" placeholder="Nhập mã SKU" class="form-control input-md border border-secondary px-2" name="product_SKU" value="{{ old('product_SKU', $data->product_SKU) }}"/>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="stock_status" class="col-md-4 control-label fw-bold">Trạng thái đơn hàng</label>
                            <div class="col-md-8">
                                <select class="form-control" id="stock_status" name="stock_status">
                                    <option value="in_stock" {{ old('stock_status', $data->stock_status) == 'in_stock' ? 'selected' : '' }}>Còn trong kho</option>
                                    <option value="out_of_stock" {{ old('stock_status', $data->stock_status) == 'out_of_stock' ? 'selected' : '' }}>Đã hết hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="product_image" class="col-md-4 control-label fw-bold">Ảnh sản phẩm</label>
                            <div class="col-md-8">
                                <input type="file" id="product_image" name="product_image" class="form-control input-md border border-secondary px-2">
                                @if ($data->product_image)
                                    <img src="{{ asset('img/product/' . $data->product_image) }}" style="width:120px" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="product_images" class="col-md-4 control-label fw-bold">Ảnh sản phẩm con</label>
                            <div class="col-md-8">
                                <input type="file" id="thumbnails_product" name="thumbnails_product" class="form-control input-md border border-secondary px-2" multiple>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label for="category_id" class="col-md-4 control-label fw-bold">Category</label>
                            <div class="col-md-8">
                                <select class="form-control" id="category_id" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $data->category_id) == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-success float-end" type="submit">Sửa sản phẩm</button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#description'), {
                language: 'vi',
                ckfinder: {
                    uploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                toolbar: {
                    items: [
                        'fontfamily', 'fontsize', '|',
                        'heading', '|',
                        'alignment', '|',
                        'fontColor', 'fontBackgroundColor', '|',
                        'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
                        'link', '|',
                        'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'code', 'codeBlock', '|',
                        'insertTable', '|',
                        'uploadImage', '|',
                        'ckfinder',
                        'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                }
            })
            .then(editor => {})
            .catch(error => {
                console.error(error)
            });
    </script>
    <script src="{{ asset('ckfinder_php_3.6.1/ckfinder/ckfinder.js') }}"></script>
    <script>
        function openPopup(idobj) {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function(finder) {
                    finder.on('files:choose', function(evt) {
                        var file = evt.data.files.first();
                        document.getElementById(idobj).value = file.getUrl();
                    });
                    finder.on('file:choose:resizedImage', function(evt) {
                        document.getElementById(idobj).value = evt.data.resizedUrl;
                    });
                }
            });
        }
    </script>
@endsection