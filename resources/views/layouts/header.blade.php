<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>

<body ng-controller="MyController">
    <a href="https://id.zalo.me/account?continue=https://chat.zalo.me" class="zalo-me"><img src="{{ asset('img/linhtinh/zalo.png') }}" style="height: 50px;"
            alt=""></a>
    <a href="#" class="scrollToTopBtn"><i class="fa-solid fa-arrow-up"></i></a>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <h2 class="fs-2">BAOAN STORE</h2>
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-3 justify-content-center mb-md-0">
                <form class="d-flex" role="search">
                    <input class="form-control rounded-0 border border-secondary-subtle" type="search"
                        style="font-size: 13px;" placeholder="Nhập tìm kiếm của bạn ..." aria-label="Search">
                    <button class="btn btn-dark rounded-0" type="submit" style="font-size: 14px;">Tìm</button>
                </form>
            </ul>

            <div class="col-md-3 text-end my-0 d-flex justify-content-center group-cart-user">
                <div class="cart position-relative">
                    <a href="{{ route('cart') }}" class="text-decoration-none text-dark px-2"><i class="fa-solid fa-bag-shopping mx-2"></i>Giỏ
                        hàng</a>
                    <div class="quantity-cart position-absolute">
                        <span>0</span>
                    </div>
                </div>

                @if(session()->has('role'))
                    <div class="nav-item action-user mx-2">
                        <span style="cursor: pointer;">Hi: {{ session()->get('name') }}</span>
                        <div class="subnav subnav-user">
                            <ul>
                                <li>
                                    <i class='bx bx-chevron-right' style="transform: translateY(5px);"></i>
                                    <a href="#" style="font-size:13px;">Đơn hàng</a>
                                </li>
                                <li>
                                    <i class='bx bx-chevron-right' style="transform: translateY(5px);"></i>
                                    <a href="#" style="font-size:13px;">Lịch sử mua hàng</a>
                                </li>
                                <li>
                                    <i class='bx bx-chevron-right' style="transform: translateY(5px);"></i>
                                    <a href="#" style="font-size:13px;">Cài đặt tài khoản</a>
                                </li>
                                @if(session()->get('role') == 0)
                                    <li>
                                        <i class='bx bx-chevron-right' style="transform: translateY(5px);"></i>
                                        <a href="#" style="font-size:13px;">Vào trang quản lí</a>
                                    </li>
                                @endif
                                <li>
                                    <i class='bx bx-chevron-right' style="transform: translateY(5px);"></i>
                                    <a href="{{ route('logout') }}" style="font-size:13px;">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-user mx-2"></i>Đăng nhập
                    </a>
                @endif


            </div>
        </header>
    </div>
    <nav class="navbar navbar-expand-lg bg-dark" id="menu">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa-solid fa-bars text-white"></i></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center text-white" id="navbarNav">
            <ul class="navbar-nav mx-2">
                <li class="nav-item mx-md-2"><a href="{{ route('index') }}" class="nav-link text-white">Trang chủ</a></li>
                <li class="nav-item mx-md-2"><a href="{{ route('product-page') }}" class="nav-link text-white">Sản phẩm</a></li>
                <li class="nav-item mx-md-2"><a href="{{ route('product-sale-page') }}" class="nav-link text-white">Sản phẩm giảm giá</a></li>
                <li class="nav-item mx-md-2"><a href="{{ route('cart') }}" class="nav-link text-white">Giỏ hàng</a></li>
                <li class="nav-item mx-md-2"><a href="{{ route('about') }}" class="nav-link text-white">Giới thiệu</a></li>
                <li class="nav-item mx-md-2"><a href="{{ route('contact') }}" class="nav-link text-white">Liên hệ</a></li>
            </ul>
        </div>
    </nav>
