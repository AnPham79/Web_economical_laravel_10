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
                                        <h2 class="fw-bold">{{ $title }}</h2>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <a href="" class="btn btn-success float-end mx-1">Add
                                            new
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
                                <div class="alert alert-success" role="alert">
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
                                                <a value="{{ $modal ?? '' }}" style="text-decoration: underline; cursor: pointer;" href="" 
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    {{ $product->product_name }}
                                                </a>
                                            </td>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin sản phẩm</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>Mô tả sản phẩm: </b>{{ $product->product_description }}</p>
                                                        <p><b>Mã SKU:</b> {{ $product->product_SKU }}</p>
                                                        <p><b>Ngày tạo: </b>{{ $product->created_at }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <td><img src="{{ asset('img/product') }}/{{ $product->product_image }}.jpg" alt="" style="height:100px"></td>
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
                                            <td class="d-flex justify-content-center">
                                                <a href=""><i class="fa-solid fa-pen-to-square text-info"></i></i></a>
                                                <form action="" method="POST">
                                                    @csrf
                                                    <button class="border-0 bg-light mx-1"><a href=""><i class="fa-solid fa-trash text-danger"></i></a></button>
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
@endsection