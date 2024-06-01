@extends('layouts.master')

@section('content')
    <main>
        <div class="container my-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item">
                        Chi tiết sản phẩm
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->product_name }}</li>
                </ol>
            </nav>
            <div class="row mt-5">
                <div class="col-lg-2 d-none d-md-block">
                    <div class="row">
                        <img src="{{ asset('img/product') }}/{{ $data->product_image }}" class="d-block w-100" alt="{{ $data->product_name }}">
                        @if ($data->product_images)
                            @foreach(json_decode($data->product_images, true) as $image)
                                <img src="{{ asset('img/thumbnail') }}/{{ $image }}" class="d-block w-100" alt="{{ $data->product_name }}">
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <!-- Hiện carousel ở màn hình md và lớn hơn -->
                    <div class="carousel slide" id="carouselExampleAutoplaying" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('img/product') }}/{{ $data->product_image }}" class="d-block w-100" alt="{{ $data->product_name }}">
                            </div>
                            @if($data->product_images)
                                @foreach(json_decode($data->product_images, true) as $image)
                                    <div class="carousel-item">
                                        <img src="{{ asset('img/thumbnail') }}/{{ $image }}" class="d-block w-100" alt="{{ $data->product_name }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="prev">
                            <i class='bx bxs-chevron-left text-dark fs-1'></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="next">
                            <i class='bx bxs-chevron-right text-dark fs-1'></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="product-detail">
                        <div class="product-detail-name mb-4">
                            <h5 class="fs-4 fw-bold">{{ $data->product_name }}</h5>
                        </div>
                        <div class="product-detail-brand">
                            <span class="text-secondary">Thương hiệu: BAOAN
                                STORE</span>
                        </div>
                        <div class="product-detail-sku">
                            <span class="text-secondary">Mã SP:
                                {{ $data->product_SKU }}</span>
                        </div>
                        <div class="product-detail-price mt-4">
                            @if($data->product_percent_sale > 0)
                                @php
                                    $price_sale = $data->product_regular_price * (1 - $data->product_percent_sale / 100);
                                @endphp
                                <span class="text-white my-2" style="background-color: red; padding:5px 10px; margin-bottom: 5px;">{{ number_format($data->product_percent_sale) }}%</span>
                                <p class="text-secondary mt-2" style="text-decoration: line-through; font-size:15px; margin-bottom: 0;" class="fs-4 fw-bold">{{ number_format($data->product_regular_price) }} VND</p>
                                <p class="fs-4 fw-bold py-3" style="margin-bottom: 0;">{{ number_format($price_sale) }} VND</p>
                            @else
                                <p class="fs-4 fw-bold pb-4" style="margin-bottom: 0;">{{ number_format($data->product_regular_price) }} VND</p>
                            @endif
                        </div>

                        <div class="product-detail-size mb-4" ng-controller="SizeController">
                            <p class="fw-bold mb-2" style="margin-bottom: 0px;">Kích thước</p>
                            <button class="size-btn btn btn-outline border border-secondary-subtle rounded-0"
                                style="font-size: 13px;" ng-click="selectSize(38)">size 38</button>
                            <button class="size-btn btn btn-outline border border-secondary-subtle rounded-0"
                                style="font-size: 13px;" ng-click="selectSize(39)">size 39</button>
                            <button class="size-btn btn btn-outline border border-secondary-subtle rounded-0"
                                style="font-size: 13px;" ng-click="selectSize(40)">size 40</button>
                            <button class="size-btn btn btn-outline border border-secondary-subtle rounded-0"
                                style="font-size: 13px;" ng-click="selectSize(41)">size 41</button>
                        </div>

                        <div class="product-detail-instruct">
                            <a href data-bs-toggle="modal" data-bs-target="#exampleModal"> Hướng dẫn
                                chọn size tại đây</a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content" style="z-index: 99999;">
                                    <div class="modal-header text-center">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">HƯỚNG DẪN
                                            CHỌN SIZE</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                    <table class="table table-bordered text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>SIZE</th>
                                                                <th>VAI
                                                                    (cm)</th>
                                                                <th>NGỰC
                                                                    (cm)</th>
                                                                <th>EO
                                                                    (cm)</th>
                                                                <th>MÔNG
                                                                    (cm)</th>
                                                                <th>CÂN NẶNG
                                                                    (kg)</th>
                                                                <th>CHIỀU
                                                                    CAO
                                                                    (cm)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>S -
                                                                    02</td>
                                                                <td>35</td>
                                                                <td>82</td>
                                                                <td>66</td>
                                                                <td>86</td>
                                                                <td>45 -
                                                                    50</td>
                                                                <td>150 -
                                                                    160</td>
                                                            </tr>
                                                            <tr>
                                                                <td>M -
                                                                    04</td>
                                                                <td>36</td>
                                                                <td>86</td>
                                                                <td>70</td>
                                                                <td>90</td>
                                                                <td>51 -
                                                                    55</td>
                                                                <td>155 -
                                                                    160</td>
                                                            </tr>
                                                            <tr>
                                                                <td>L -
                                                                    06</td>
                                                                <td>37</td>
                                                                <td>90</td>
                                                                <td>75</td>
                                                                <td>94</td>
                                                                <td>56 -
                                                                    60</td>
                                                                <td>155 -
                                                                    160</td>
                                                            </tr>
                                                            <tr>
                                                                <td>XL -
                                                                    08</td>
                                                                <td>38</td>
                                                                <td>94</td>
                                                                <td>80</td>
                                                                <td>98</td>
                                                                <td>61 -
                                                                    64</td>
                                                                <td>160 -
                                                                    165</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2XL -
                                                                    10</td>
                                                                <td>39</td>
                                                                <td>98</td>
                                                                <td>84</td>
                                                                <td>102</td>
                                                                <td>65 -
                                                                    68</td>
                                                                <td>160 -
                                                                    165</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3XL -
                                                                    12</td>
                                                                <td>40</td>
                                                                <td>102</td>
                                                                <td>88</td>
                                                                <td>106</td>
                                                                <td>69 -
                                                                    70</td>
                                                                <td>160 -
                                                                    165</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ------------- end modal -------------------------------- -->
                        <div class="product-detail-update-quantity d-flex my-4">
                            <p class="fw-bold px-2" style="margin-bottom: 0; transform: translateY(7px);">Số
                                lượng</p>
                            <button class="quantity-btn btn btn-dark rounded-0" type="button" onclick="decreaseQuantity()">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" id="quantityInput"
                                class="form-control border-secondary-subtle w-25 rounded-0" value="1">
                            <button class="quantity-btn btn btn-dark rounded-0" type="button"
                                onclick="increaseQuantity()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <form action="" method="POST" id="addToCartBtn">
                            <div class="product-detail-add-to-cart">
                                <button type="submit" class="btn btn-outline border-dark rounded-0 w-100 my-2">Thêm
                                    vào giỏ hàng</button>
                            </div>
                        </form>

                        <div class="product-detail-buy-now">
                            <button class="btn btn-dark border-dark rounded-0 w-100 my-2">Mua
                                Ngay</button>
                        </div>

                        <div class="product-detail-description my-3">
                            <b>Chất liệu:</b> vải tổng hợp cao cấp
                            <br>
                            <b>Kiểu dáng:</b> đầm thiết kế dáng chữ A dài
                            qua gối, tone màu xanh than kết hợp họa tiết
                            chấm bi trắng
                            <br>
                            <b>Sản phẩm thuộc dòng sản phẩm:</b> BAOAN STORE
                            <br>
                            <b>Thông tin người mẫu:</b>mặc sản phẩm size 2
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="article">
                <div class="section">
                    <h2 class="fs-5 fw-bold mb-3" style="margin-bottom: 0;">SẢN PHẨM KHÁC</h2>
                    <div class="list-product">
                        <div class="row">
                            @foreach ($more_products as $product)
                                <div class="col-lg-3 col-md-4">
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{ asset('img/product') }}/{{ $product->product_image }}" class="w-100" alt>
                                            <a href="{{ route('product-detail', ['slug' => $product->product_slug_name]) }}">
                                                <div class="over-lay">
                                                    <button>Xem thêm</button>
                                                </div>
                                            </a>
                                            @if($product->product_percent_sale > 0)
                                                <div class="sale-title">
                                                    <span>{{ number_format($product->product_percent_sale) }}%</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-name text-center py-2 fw-bold"
                                            style="font-size: 15px; color: gray;">
                                            <a href="{{ route('product-detail', ['slug' => $product->product_slug_name]) }}">{{ $product->product_name }}</a>
                                        </div>
                                        <div class="product-price text-center py-2 fw-bold">
                                            @if($product->product_percent_sale > 0)
                                                @php
                                                    $price_sale = $product->product_regular_price * (1 - $product->product_percent_sale / 100);
                                                @endphp
                                                <p class="text-secondary" style="margin-bottom: 0; text-decoration: line-through; font-size:13px">{{ number_format($product->product_regular_price) }}đ</p>
                                                <p style="margin-bottom: 0;">{{ number_format($price_sale) }}đ</p>
                                            @else
                                                <p style="margin-bottom: 0;">{{ number_format($product->product_regular_price) }}đ</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="view-all-product d-flex justify-content-center mt-4">
                        <a href="./product.html" class="text-decoration-none"><button class="btn btn-dark rounded-0">Xem
                                thêm</button></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Button trigger modal -->
@endsection
