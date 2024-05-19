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
        <div class="product-in_cart d-flex flex-column flex-md-row justify-content-between">
            <div class="img-product-in_cart mb-3 mb-md-0">
                <img src="{{ asset('img/product/product-18.jpg') }}" style="height: 200px;" alt="">
            </div>
            <div class="in4-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</span>
                <p class="mb-0">Thương hiệu: BAOAN STORE</p>
                <p class="mb-0">size: 43</p>
            </div>
            <div class="price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>1.003.780 VND</span>
            </div>
            <div class="in4-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <button class="btn btn-dark rounded-0"><i class="fa-solid fa-minus"></i></button>
                <span>1</span>
                <button class="btn btn-dark rounded-0"><i class="fa-solid fa-plus"></i></button>
            </div>
            <div class="total-price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>1.003.780 VND</span>
            </div>
            <div class="delete-product-in_cart" style="transform: translateY(30%);">
                <a href="" style="text-decoration: none; color: black;">xóa</a>
            </div>
        </div>
        <div class="product-in_cart d-flex flex-column flex-md-row justify-content-between">
            <div class="img-product-in_cart mb-3 mb-md-0">
                <img src="{{ asset('img/product/product-17.jpg') }}" style="height: 200px;" alt="">
            </div>
            <div class="in4-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</span>
                <p class="mb-0">Thương hiệu: BAOAN STORE</p>
                <p class="mb-0">size: 43</p>
            </div>
            <div class="price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>1.003.780 VND</span>
            </div>
            <div class="in4-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <button class="btn btn-dark rounded-0"><i class="fa-solid fa-minus"></i></button>
                <span>1</span>
                <button class="btn btn-dark rounded-0"><i class="fa-solid fa-plus"></i></button>
            </div>
            <div class="total-price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>1.003.780 VND</span>
            </div>
            <div class="delete-product-in_cart" style="transform: translateY(30%);">
                <a href="" style="text-decoration: none; color: black;">xóa</a>
            </div>
        </div>
        <div class="product-in_cart d-flex flex-column flex-md-row justify-content-between">
            <div class="img-product-in_cart mb-3 mb-md-0">
                <img src="{{ asset('img/product/product-28.jpg') }}" style="height: 200px;" alt="">
            </div>
            <div class="in4-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</span>
                <p class="mb-0">Thương hiệu: BAOAN STORE</p>
                <p class="mb-0">size: 43</p>
            </div>
            <div class="price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>1.003.780 VND</span>
            </div>
            <div class="in4-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <button class="btn btn-dark rounded-0"><i class="fa-solid fa-minus"></i></button>
                <span>1</span>
                <button class="btn btn-dark rounded-0"><i class="fa-solid fa-plus"></i></button>
            </div>
            <div class="total-price-product-in_cart mb-3 mb-md-0" style="transform: translateY(30%);">
                <span>1.003.780 VND</span>
            </div>
            <div class="delete-product-in_cart" style="transform: translateY(30%);">
                <a href="" style="text-decoration: none; color: black;">xóa</a>
            </div>
        </div>
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
                <span>WELCOME</span>
            </div>
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Giá giảm:</p>
                <span>- 300.000 VND</span>
            </div>
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Tổng tiền tạm thời:</p>
                <span>2.700.000 VND</span>
            </div>
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Tiền ship:</p>
                <span>+ 30.000 VND</span>
            </div>
            <div class="group-total d-flex justify-content-between">
                <p class="mb-0">Tổng tiền:</p>
                <span>2.730.000 VND</span>
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
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('img/product/product-1.jpg') }}"
                                        class="w-100" alt>
                                    <div class="over-lay">
                                        <button>Xem thêm</button>
                                    </div>
                                </div>
                                <div
                                    class="product-name text-center py-2 fw-bold"
                                    style="font-size: 15px; color: gray;">
                                    <a href>Đầm chấm bi 3002D23</a>
                                </div>
                                <div
                                    class="product-price text-center py-2 fw-bold">
                                    <p
                                        style="margin-bottom: 0;">1.000.389đ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('img/product/product-2.jpg') }}"
                                        class="w-100" alt>
                                    <div class="over-lay">
                                        <button>Xem thêm</button>
                                    </div>
                                </div>
                                <div
                                    class="product-name text-center py-2 fw-bold"
                                    style="font-size: 15px; color: gray;">
                                    <a href>Đầm chấm bi 3002D23</a>
                                </div>
                                <div
                                    class="product-price text-center py-2 fw-bold">
                                    <p
                                        style="margin-bottom: 0;">1.000.389đ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('img/product/product-3.jpg') }}"
                                        class="w-100" alt>
                                    <div class="over-lay">
                                        <button>Xem thêm</button>
                                    </div>
                                </div>
                                <div
                                    class="product-name text-center py-2 fw-bold"
                                    style="font-size: 15px; color: gray;">
                                    <a href>Đầm chấm bi 3002D23</a>
                                </div>
                                <div
                                    class="product-price text-center py-2 fw-bold">
                                    <p
                                        style="margin-bottom: 0;">1.000.389đ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('img/product/product-4.jpg') }}"
                                        class="w-100" alt>
                                    <div class="over-lay">
                                        <button>Xem thêm</button>
                                    </div>
                                </div>
                                <div
                                    class="product-name text-center py-2 fw-bold"
                                    style="font-size: 15px; color: gray;">
                                    <a href>Đầm chấm bi 3002D23</a>
                                </div>
                                <div
                                    class="product-price text-center py-2 fw-bold">
                                    <p
                                        style="margin-bottom: 0;">1.000.389đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="view-all-product d-flex justify-content-center mt-4">
                    <a href="./product.html" class="text-decoration-none"><button
                            class="btn btn-dark rounded-0">Xem thêm</button></a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection