@extends('admin.layouts.master')

@section('content')
    <main>
        <div>
            <style>
                nav svg {
                    height: 20px;
                }

                nav .hidden {
                    display: block !important;
                }
            </style>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="fw-bold">Quản lí sản phẩm</h2>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <a href="{{ route('product.create-product') }}" class="btn btn-success float-end mx-1">Thêm mới
                                        </a>
                                        <form action="" method="POST">
                                            @csrf
                                            <button class="btn btn-success float-end mx-1">
                                                Export CSV
                                            </button>
                                        </form>
                                        <form action="" method="POST">
                                            @csrf
                                            <button class="btn btn-success float-end mx-1">
                                                Export Excel
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="" class="form-horizontal my-4" id="form-filter">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-select px-4 rounded-pill bg-light border-0 shadow-sm select-filter"
                                        aria-label="Default select example" name="role" id="role">
                                        <option value="All" selected>Tất cả sản phẩm</option>
                                        <option value="Applicant">Giá tăng dần</option>
                                        <option value="HR">Giá giảm dần</option>
                                        <option value="Admin">Sale</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <div class="panel-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success text-white" role="alert">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <table class="table table-triped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Mô tả ngắn</th>
                                        <th>Giá</th>
                                        <th>Giảm giá</th>
                                        <th>Số lượng</th>
                                        <th>Tình trạng</th>
                                        <th>Danh mục</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center text-center">
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            {{-- style="text-decoration: underline; "  --}}
                                            <td>
                                                <p>{{ $product->product_name }}</p>
                                            </td>
                                            <td><img src="{{ asset('img/product') }}/{{ $product->product_image }}" alt="" style="height:100px"></td>
                                            <td>{{ $product->product_short_description }}</td>
                                            <td>{{ number_format($product->product_regular_price) }}đ</td>
                                            <td>{{ number_format($product->product_percent_sale) }}%</td>
                                            <td>{{ $product->product_quantity }}</td>
                                            @if($product->stock_status == 'in_stock')
                                                <td>Trong kho</td>
                                            @else
                                                <td>Hết hàng</td>
                                            @endif
                                            <td>{{ $product->category->category_name }}</td>
                                            <td id="deleteForm" class="d-flex justify-content-center">
                                                <a href="{{ route('product.edit-product', ['slug' => $product->product_slug_name]) }}"><i class="fa-solid fa-pen-to-square text-info"></i></i></a>

                                                <button class="border-0 bg-light mx-1" onclick="confirmDelete({{ $product->id }})"><i class="fa-solid fa-trash text-danger"></i></button>
                                               
                                                <form action="{{ route('product.delete-product', ['slug' => $product->product_slug_name]) }}" method="POST" id="delete-product{{ $product->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function confirmDelete(id) {
            var result = confirm('Bạn có muốn xóa sản phẩm này không')

            if(result == true)
            {
                document.getElementById('delete-product'+id).submit();
            }
        }
    </script>
@endsection