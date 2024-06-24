@extends('layouts.master')

@section('content')
<main id="main" class="main-site">
    <div class="container" style="padding: 60px 0px">
        <div class="root-process-payment text-center d-flex justify-content-center fs-5 fs-md-4 fw-bold my-5">
            <div class="root-cart px-3 px-sm-4 px-md-5" style="color: rgb(190, 190, 190);">
                <i class='bx bxs-shopping-bag' style="transform: translateY(5px);"></i>
                <span>GIỎ HÀNG</span>
            </div>
            <div class="dotted-line"></div>
            <div class="root-cart px-3 px-sm-4 px-md-5" style="color: rgb(190, 190, 190);">
                <i class='bx bx-archive' style="transform: translateY(5px);"></i>
                <span>ĐẶT HÀNG</span>
            </div>
            <div class="dotted-line"></div>
            <div class="root-cart px-3 px-sm-4 px-md-5 text-dark">
                <i class='bx bxs-package' style="transform: translateY(5px);"></i>
                <span>HOÀN TẤT ĐẶT HÀNG</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Cảm ơn đã mua hàng tại của hàng của chúng tôi !!!</h2>
                <p>Thông tin đơn hàng sẽ được gửi đến bạn sau ít phút.</p>
                <a href="{{ route('index') }}" class="btn btn-dark">Về trang chủ</a>
                <p class="mt-2">Hoặc</p>
                <a href="{{ route('order-history') }}" class="btn btn-dark">Xem đơn</a>
                <div class="mt-3">
                    <a href="{{ route('product-page') }}" class="text-decoration-none">Tiếp tục mua hàng</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection