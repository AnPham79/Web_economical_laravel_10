@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h1>Kết quả tìm kiếm cho "{{ request()->input('search') }}"</h1>

        @if ($searchResults->isEmpty())
            <div class="text-center">
                <span>Không tìm thấy sản phẩm nào.</span>
            </div>
        @else
            <div class="list-product mt-5">
                <div class="row">
                    @foreach ($searchResults as $product)
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="product-img">
                                    <img src="{{ asset('img/product') }}/{{ $product->product_image }}" class="w-100" alt>
                                    <a href="{{ route('product-detail', ['slug' => $product->product_slug_name]) }}">
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
                                <div class="product-name text-center py-2 fw-bold" style="font-size: 15px; color: gray;">
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
                                        <p style="margin-bottom: 0;">{{ number_format($product->product_regular_price) }}đ
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
