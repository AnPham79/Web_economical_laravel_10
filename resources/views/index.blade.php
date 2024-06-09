@extends('layouts.master')

@section('content')
    <main>
        <div class="banner">
            <div id="carouselExampleDesktop" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/banner.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/banner_1.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDesktop"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDesktop"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div id="carouselExampleMobile" class="carousel slide d-md-none" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/banner_mb.jpg') }}" class="w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/banner_mb_1.jpg') }}" class="w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleMobile"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleMobile"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="thumnail-home">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 p-0" style="margin-top: 10px;">
                        <div class="thumnail-1 " style="padding-right: 5px;">
                            <img src="{{ asset('img/thumnail_1.jpg') }}" class="w-100" alt>
                            <div class="thumnail-content">
                                <span>FLORAL DRESS</span>
                                <a href>Xem ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 p-0" style="margin-top: 10px;">
                        <div class="thumnail-2" style="padding-left: 5px;">
                            <img src="{{ asset('img/thumnail_2.jpg') }}" class="w-100" alt>
                            <div class="thumnail-content">
                                <span>MAXI</span>
                                <a href>Xem ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ------------------------------------------  product new ---------------------------------------------- -->
        <div class="container">
            <div class="article">
                <div class="section">
                    <h2 class="fw-bold text-center fs-2 my-4 pt-5" style="margin-bottom: 0;">SẢN PHẨM MỚI</h2>
                    <div class="list-product">
                        <div class="row">
                            @foreach ($products_new as $product)
                                <div class="col-lg-3 col-md-4">
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{ asset('img/product') }}/{{ $product->product_image }}" class="w-100" alt>
                                            <a href="{{ route('product-detail', ['slug' => $product->product_slug_name]) }}">
                                                <div class="over-lay">
                                                    <button>Xem thêm</button>
                                                </div>
                                            </a>
                                            <div class="new-title">
                                                <span>NEW</span>
                                            </div>
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
                        <a href="{{ route('product-page') }}" class="text-decoration-none"><button class="btn btn-dark rounded-0">Xem tất
                                cả</button></a>
                    </div>
                </div>
            </div>

        </div>
        <!-- ------------------------------ end new product -------------------------------------------- -->

        <!-- -------------------------------- product sale ---------------------------------------------- -->
        <div class="container">
            <div class="article">
                <div class="section">
                    <h2 class="fw-bold text-center fs-2 my-4 pt-5" style="margin-bottom: 0;">SẢN PHẨM GIẢM GIÁ</h2>
                    <div class="list-product">
                        <div class="row">
                            @foreach ($products_sale as $product)
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
                        <a href="{{ route('product-sale-page') }}" class="text-decoration-none"><button class="btn btn-dark rounded-0">Xem tất
                                cả</button></a>
                    </div>
                </div>
            </div>

        </div>
        <!--  ----------------------------- end product sale ----------------------------------------------------- -->

        <!-- ------------------------------- banner article ----------------------------------------------------- -->
        <div class="banner-article">
            <img src="{{ asset('img/banner-article.jpg') }}" class="w-100 my-4 pt-5" alt>
        </div>
        <!-- -------------------------------- end banner article ----------------------------------------------------- -->

        <!-- -------------------------------- BaoAn Store ---------------------------------------------- -->
        <div class="container">
            <div class="article">
                <div class="section">
                    <h2 class="fw-bold text-center fs-2 my-3 pt-5" style="margin-bottom: 0;">BAOANSTORE'S BLOG</h2>
                    <p class="text-secondary text-center mb-4" style="font-size: 13px;">ĐÓN ĐẦU XU HƯỚNG, ĐỊNH HÌNH
                        PHONG CÁCH</p>
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <img src="{{ asset('img/blog/blog1.jpg') }}" class="w-100" style="height: 250px;" alt>
                            <p class="text-center pt-3">3 MẪU TRANG PHỤC CỔ
                                VEST
                                THANH LỊCH VÀ SANG TRỌNG CHO CÔ NÀNG CÔNG
                                SỞ</p>
                        </div>
                        <div class="item">
                            <img src="{{ asset('img/blog/blog2.jpg') }}" class="w-100" style="height: 250px;" alt>
                            <p class="text-center pt-3">SUMMER FESTIVAL - ÁO
                                PHÔNG CHỈ TỪ 299K</p>
                        </div>
                        <div class="item">
                            <img src="{{ asset('img/blog/blog3.jpg') }}" class="w-100" style="height: 250px;" alt>
                            <p class="text-center pt-3">ẤN TƯỢNG CÙNG ĐẦM
                                THẮT
                                NƠ</p>
                        </div>
                        <div class="item">
                            <img src="{{ asset('img/blog/blog4.jpg') }}" class="w-100" style="height: 250px;" alt>
                            <p class="text-center pt-3">MINIMAL CHIC</p>
                        </div>
                        <div class="item">
                            <img src="{{ asset('img/blog/blog5.jpg') }}" class="w-100" style="height: 250px;" alt>
                            <p class="text-center pt-3">3 CÁCH DIỆN SƠ MI
                                ĐẸP
                                ĐÚNG CHUẨN</p>
                        </div>
                        <div class="item">
                            <img src="{{ asset('img/blog/blog6.jpg') }}" class="w-100" style="height: 250px;" alt>
                            <p class="text-center pt-3">SUIT - XU HƯỚNG THỜI
                                TRANG CHO QUÝ CÔ QUYỀN LỰC</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  ----------------------------- end BaoAn Store ----------------------------------------------------- -->

        <!-- ------------------------------- Đăng kí bảng tin --------------------------------------------------- -->
        <div class="container mb-4">
            <div class="article">
                <div class="section">
                    <h2 class="fw-bold text-center fs-2 my-3 pt-5" style="margin-bottom: 0;">ĐĂNG KÍ BẢNG TIN</h2>
                    <p class="text-secondary text-center mb-4" style="font-size: 13px;">Đăng ký nhận bản tin
                        BAOANSTORE
                        để được cập nhật những mẫu thiết kế mới nhất</p>
                    <form action>
                        <div class="form-group d-flex justify-content-center">
                            <input type="text" class="form-control w-50 border border-secondary-subtle rounded-0"
                                placeholder="vui lòng nhập email của bạn ..." style="font-size: 13px;">
                            <button class="btn btn-dark rounded-0 fw-bold" style="padding: 5px 20px;">Đăng kí</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- -------------------------------- end đăng kí bảng tin ---------------------------------------------- -->

        <!-- ------------------------------- social link --------------------------------------------------------- -->
        <div class="social-link-group justify-content-center">
            <div class="group-social-item mx-1 bg-primary">
                <a href><i class='bx bxl-facebook'></i></a>
            </div>
            <div class="group-social-item mx-1 bg-danger">
                <a href><i class='bx bxl-instagram-alt'></i></a>
            </div>
            <div class="group-social-item mx-1 bg-info">
                <a href><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
        <!-- --------------------------------end social link ----------------------------------------------------- -->
    </main>
@endsection
