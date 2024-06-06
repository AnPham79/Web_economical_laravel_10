@extends('layouts.master')

@section('content')
<main class="mt-5">
    <div
        class="root-process-payment text-center d-flex justify-content-center fs-5 fs-md-4 fw-bold">
        <div class="root-cart px-3 px-sm-4 px-md-5">
            <i class='bx bxs-shopping-bag'
                style="transform: translateY(5px);"></i>
            <span>GIỎ HÀNG</span>
        </div>
        <div class="dotted-line"></div>
        <div class="root-cart px-3 px-sm-4 px-md-5"  style="color: rgb(190, 190, 190);">
            <i class='bx bx-archive'
                style="transform: translateY(5px);"></i>
            <span>ĐẶT HÀNG</span>
        </div>
        <div class="dotted-line"></div>
        <div class="root-cart px-3 px-sm-4 px-md-5"  style="color: rgb(190, 190, 190);">
            <i class='bx bxs-package'
                style="transform: translateY(5px);"></i>
            <span>HOÀN TẤT ĐẶT HÀNG</span>
        </div>
    </div>

    <div class="container pt-5">
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

        @foreach($cart as $item)
            <div class="product-in_cart d-flex flex-column flex-md-row justify-content-between">
                <div class="img-product-in_cart mb-3 mb-md-0">
                    <img src="{{ asset('img/product') }}/{{ $item->product->product_image }}" style="height: 200px;" alt="">
                </div>
                <div class="in4-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                    <span><b>Tên sản phẩm:</b> {{ $item->product->product_name }}</span>
                    <p class="mb-0"><b>Thương hiệu:</b> BAOAN STORE</p>
                    <p class="mb-0"><b>size:</b> {{ $item->size->size }}</p>
                </div>
                @if($item->product->product_percent_sale !== null)
                    <div class="price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        <span class="text-secondary" style="text-decoration: line-through;">{{ number_format($item->product->product_regular_price) }} VND</span>
                    </div>
                @else
                    <div class="price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        <span>{{ number_format($item->product->product_regular_price) }} VND</span>
                    </div>
                @endif

                @if($item->product->product_percent_sale == null)
                    <div class="price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        <span>Không giảm giá</span>
                    </div>
                @else
                    <div class="price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        <span>{{ number_format($item->product->product_regular_price * (1 - $item->product->product_percent_sale / 100)) }} VND</span>
                    </div>
                @endif
                <div class="in4-product-in_cart mb-3 mb-md-0 d-flex" style="transform: translateY(30%);">
                    <form action="{{ route('decrease-quantity-product', ['slug' => $item->product->product_slug_name]) }}" method="POST" class="mx-1">
                        @csrf
                        <button class="btn btn-dark rounded-0"><i class="fa-solid fa-minus"></i></button>
                    </form>
                    <span style="transform: translateY(7px)">{{ $item->product_quantity }}</span>
                    <form action="{{ route('increase-quantity-product', ['slug' => $item->product->product_slug_name]) }}" method="POST" class="mx-1">
                        @csrf
                        <button class="btn btn-dark rounded-0"><i class="fa-solid fa-plus"></i></button>
                    </form>
                </div>
                @if($item->product->product_percent_sale == null)
                    <div class="total-price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        <span>{{ number_format($item->product->product_regular_price * $item->product_quantity) }} VND</span>
                    </div>
                @else
                    @php
                        $price_sale = $item->product->product_regular_price * (1 - $item->product->product_percent_sale / 100);
                    @endphp
                    <div class="total-price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        <span>{{ number_format($price_sale * $item->product_quantity) }} VND</span>
                    </div>
                @endif
                <div class="delete-product-in_cart" style="transform: translateY(30%);">
                    <form action="{{ route('delete-product-in-cart', ['slug' => $item->product->product_slug_name]) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container mt-5">
        <form action="" class="mb-4">
            <span class="fs-5 fw-bold">Dùng mã giảm giá</span>
            <div class="input-group mt-2">
                <input type="text" class="form-control border border-secondary-subtle rounded-0" placeholder="Nhập mã giảm giá">
                <button class="btn btn-dark rounded-0">Dùng</button>
            </div>
        </form>
    </div>
    
    <div class="container mt-5">
        <div class="total-cart">
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Mã giảm giá:</p>
                <span>Không có</span>
            </div>
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Giá giảm:</p>
                <span>0 VND</span>
            </div>
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Tổng tiền tạm thời:</p>
                <span>{{ number_format($totalPrice) }} VND</span>
            </div>
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Tiền ship:</p>
                <span>Free ship</span>
            </div>
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Tổng tiền:</p>
                <span>{{ number_format($totalPrice) }} VND</span>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <a href="./order.html"><button class="btn btn-dark rounded-0 w-100">Thanh toán ngay</button></a>
    </div>

    <div class="container mt-5">
        <div class="article">
            <div class="section">
                <h2 class="fs-5 fw-bold mb-3"
                    style="margin-bottom: 0;">SẢN PHẨM KHÁC</h2>
                <div class="list-product">
                    <div class="row">
                        @foreach ($products as $product)
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
                <div
                    class="view-all-product d-flex justify-content-center mt-4">
                    <a href="{{ route('product-page') }}" class="text-decoration-none"><button
                            class="btn btn-dark rounded-0">Xem thêm</button></a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection