@extends('layouts.master')

@section('content')
    <main class="mt-5">
        <div class="root-process-payment text-center d-flex justify-content-center fs-5 fs-md-4 fw-bold">
            <div class="root-cart px-3 px-sm-4 px-md-5">
                <i class='bx bxs-shopping-bag' style="transform: translateY(5px);"></i>
                <span>GIỎ HÀNG</span>
            </div>
            <div class="dotted-line"></div>
            <div class="root-cart px-3 px-sm-4 px-md-5" style="color: rgb(190, 190, 190);">
                <i class='bx bx-archive' style="transform: translateY(5px);"></i>
                <span>ĐẶT HÀNG</span>
            </div>
            <div class="dotted-line"></div>
            <div class="root-cart px-3 px-sm-4 px-md-5" style="color: rgb(190, 190, 190);">
                <i class='bx bxs-package' style="transform: translateY(5px);"></i>
                <span>HOÀN TẤT ĐẶT HÀNG</span>
            </div>
        </div>

        <div class="container py-5">
            @if (session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @forelse ($cart as $item)
                <div class="product-in_cart d-flex flex-column flex-md-row justify-content-between">
                    <div class="img-product-in_cart mb-3 mb-md-0">
                        <img src="{{ asset('img/product') }}/{{ $item->product->product_image }}" style="height: 200px;" alt="">
                    </div>
                    <div class="in4-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        <span><b>Tên sản phẩm:</b> {{ $item->product->product_name }}</span>
                        <p class="mb-0"><b>Thương hiệu:</b> BAOAN STORE</p>
                        <p class="mb-0"><b>size:</b> {{ $item->size->size }}</p>
                    </div>


                    <div class="price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        @if ($item->product->product_percent_sale !== null)
                            <span class="text-secondary mx-5" style="text-decoration: line-through;">
                                {{ number_format($item->product->product_regular_price) }} VND
                            </span>
                        @endif
                        <span>
                            {{ number_format($item->product->product_regular_price * (1 - $item->product->product_percent_sale / 100)) }} VND
                        </span>
                        <span class="mx-5">{{ $item->product->product_percent_sale ? '' : 'Không giảm giá' }}</span>
                    </div>


                    <div class="in4-product-in_cart mb-3 mb-md-0 d-flex" style="transform: translateY(30%);">
                        <form action="{{ route('decrease-quantity-product', ['slug' => $item->product->product_slug_name, 'size' => $item->size_id]) }}" method="POST" class="mx-1">
                            @csrf
                            <button class="btn btn-dark rounded-0"><i class="fa-solid fa-minus"></i></button>
                        </form>
                        <span style="transform: translateY(7px)">{{ $item->product_quantity }}</span>
                        <form action="{{ route('increase-quantity-product', ['slug' => $item->product->product_slug_name, 'size' => $item->size_id]) }}" method="POST" class="mx-1">
                            @csrf
                            <button class="btn btn-dark rounded-0"><i class="fa-solid fa-plus"></i></button>
                        </form>
                    </div>
                    <div class="total-price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                        <span>
                            {{ number_format(($item->product->product_regular_price * (1 - $item->product->product_percent_sale / 100)) * $item->product_quantity) }} VND
                        </span>
                    </div>
                    <div class="delete-product-in_cart" style="transform: translateY(30%);">
                        <form action="{{ route('delete-product-in-cart', 
                            [
                                'slug' => $item->product->product_slug_name, 
                                'size' => $item->size_id
                            ]) 
                            }}" method="POST">
                            @csrf
                            <button class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="w-100 text-center">
                    <img src="{{ asset('img/linhtinh/cart-empty.png') }}" class="w-50" alt="">
                </div>
            @endforelse

        </div>

        @if($cart->count() > 0)
            <div class="container">

                @if (session()->has('coupon-success'))
                    <div class="alert alert-success">
                        {{ session('coupon-success') }}
                    </div>
                @endif

                @if (session()->has('coupon-error'))
                    <div class="alert alert-danger">
                        {{ session('coupon-error') }}
                    </div>
                @endif

                @if (session()->has('unUseCoupon') || isset($unUseCoupon))
                    <div class="alert alert-success">
                        {{ session('unUseCoupon') ?? $unUseCoupon }}
                    </div>
                @endif

                <form action="{{ route('use-coupon') }}" method="GET" class="mb-4">
                    @csrf
                    <span class="fs-5 fw-bold">Dùng mã giảm giá</span>
                    <div class="input-group mt-2">
                        <input type="text" name="code" value="{{ session()->get('code') ?? '' }}"
                            class="form-control border border-secondary-subtle rounded-0" placeholder="Nhập mã giảm giá">
                        <button class="btn btn-dark rounded-0">Dùng</button>
                    </div>
                </form>

                @if(session()->has('code'))
                    <a href="{{ route('un-use-coupon') }}">Hủy dùng mã giảm giá</a>
                @endif

            </div>

            <div class="container mt-5">
                <div class="total-cart">
                    <div class="group-total d-flex justify-content-between">
                        <p class="mb-0">Tổng tiền tạm thời:</p>
                        <span>{{ number_format($subtotalFixed) }} VND</span>
                    </div>
                    <div class="group-total d-flex justify-content-between">
                        <p class="mb-0">Mã giảm giá:</p>
                        @if(session()->has('code'))
                            <span>{{ session()->get('code') }}</span>
                        @else
                            <span>Không có</span>
                        @endif
                    </div>
                    <div class="group-total d-flex justify-content-between">
                        <p class="mb-0">Giá trị giảm:</p>
                        @php
                            $couponValue = session()->get('coupon_value');
                            $couponType = session()->get('type');
                        @endphp
                        @if (!is_null($couponValue) && !is_null($couponType))
                            <span>{{ $couponType == 'percent' ? number_format($couponValue) . '%' : number_format($couponValue) . ' VND' }}</span>
                        @else
                            <span>Không có</span>
                        @endif
                    </div>                
                    <div class="group-total d-flex justify-content-between">
                        <p class="mb-0">Giá giảm:</p>
                        <span>{{ number_format($discountAmount) }} VND</span>
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
                <a href="{{ route('check-out') }}"><button class="btn btn-dark rounded-0 w-100 ">Tiến hành đặt hàng</button></a>
            </div>
        @else
            <div class="container text-center">
                <a href="{{ route('product-page') }}">Giỏ hàng của bạn chưa có sản phẩm nào, nhấn vào đây để đi mua sắm nhé</a>
            </div>
        @endif

        <div class="container mt-5">
            <div class="article">
                <div class="section">
                    <h2 class="fs-5 fw-bold mb-3" style="margin-bottom: 0;">SẢN PHẨM KHÁC</h2>
                    <div class="list-product">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-md-4">
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{ asset('img/product') }}/{{ $product->product_image }}"
                                                class="w-100" alt>
                                            <a
                                                href="{{ route('product-detail', ['slug' => $product->product_slug_name]) }}">
                                                <div class="over-lay">
                                                    <button>Xem thêm</button>
                                                </div>
                                            </a>
                                            @if ($product->product_percent_sale > 0)
                                                <div class="sale-title">
                                                    <span>{{ number_format($product->product_percent_sale) }}%</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-name text-center py-2 fw-bold"
                                            style="font-size: 15px; color: gray;">
                                            <a
                                                href="{{ route('product-detail', ['slug' => $product->product_slug_name]) }}">{{ $product->product_name }}</a>
                                        </div>
                                        <div class="product-price text-center py-2 fw-bold">
                                            @if ($product->product_percent_sale > 0)
                                                @php
                                                    $price_sale =
                                                        $product->product_regular_price *
                                                        (1 - $product->product_percent_sale / 100);
                                                @endphp
                                                <p class="text-secondary"
                                                    style="margin-bottom: 0; text-decoration: line-through; font-size:13px">
                                                    {{ number_format($product->product_regular_price) }}đ</p>
                                                <p style="margin-bottom: 0;">{{ number_format($price_sale) }}đ</p>
                                            @else
                                                <p style="margin-bottom: 0;">
                                                    {{ number_format($product->product_regular_price) }}đ</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="view-all-product d-flex justify-content-center mt-4">
                        <a href="{{ route('product-page') }}" class="text-decoration-none"><button
                                class="btn btn-dark rounded-0">Xem thêm</button></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
