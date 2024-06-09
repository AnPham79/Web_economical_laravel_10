@extends('layouts.master')

@section('content')
<main>
    <div class="container" style="padding: 30px 0px">

        <div
            class="root-process-payment text-center d-flex justify-content-center fs-5 fs-md-4 fw-bold my-5">
            <div class="root-cart px-3 px-sm-4 px-md-5"
                style="color: rgb(190, 190, 190);">
                <i class='bx bxs-shopping-bag'
                    style="transform: translateY(5px);"></i>
                <span>GIỎ HÀNG</span>
            </div>
            <div class="dotted-line"></div>
            <div class="root-cart px-3 text-dark px-sm-4 px-md-5">
                <i class='bx bx-archive'
                    style="transform: translateY(5px);"></i>
                <span>ĐẶT HÀNG</span>
            </div>
            <div class="dotted-line"></div>
            <div class="root-cart px-3 px-sm-4 px-md-5"
                style="color: rgb(190, 190, 190);">
                <i class='bx bxs-package'
                    style="transform: translateY(5px);"></i>
                <span>HOÀN TẤT ĐẶT HÀNG</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row my-3">
                            <div class="col-md-6">
                                <h2 class="fw-bold">Địa chỉ giao
                                    hàng</h2>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('cart') }}"
                                    class="btn btn-dark rounded-0 text-white">Xem
                                    giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <form action="{{ route('payment-confirmation') }}" method="POST" class="row g-3" id="success-payment">
                            @csrf
                            @method("POST")
                            <div class="col-md-6">
                                <label for="inputUserName"
                                    class="form-label">Tên người
                                    dùng</label>
                                <input type="text"
                                    class="form-control border border-secondary-subtle"
                                    id="inputUserName" name="user_name"
                                    placeholder="Tên người dùng" value="{{ Auth::user()->name ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPhoneNumber"
                                    class="form-label">Số điện
                                    thoại</label>
                                <input type="text"
                                    class="form-control border border-secondary-subtle"
                                    id="inputPhoneNumber" name="mobile"
                                    placeholder="Số điện thoại">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail"
                                    class="form-label">Email</label>
                                <input type="email" name="email"
                                    class="form-control border border-secondary-subtle"
                                    id="inputEmail" placeholder="Email" value="{{ Auth::user()->email ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="inputProvince" class="form-label">Tỉnh</label>
                                <input type="text" name="province" class="form-control border-secondary-subtle" id="inputProvince" placeholder="Nhập tỉnh/thành phố">
                            </div>
                            <div class="col-md-4">
                                <label for="inputCity" class="form-label">Thành phố</label>
                                <input type="text" name="city" class="form-control border-secondary-subtle" id="inputCity" placeholder="Nhập thành phố">
                            </div>
                            <div class="col-md-4">
                                <label for="inputDistrict" class="form-label">Xã / Huyện</label>
                                <input type="text" name="commune" class="form-control border-secondary-subtle" id="inputDistrict" placeholder="Nhập xã/huyện">
                            </div>
                            </div>
                            <div class="col-12 px-2">
                                <label for="inputAddress"
                                    class="form-label">Địa chỉ cụ
                                    thể</label>
                                <textarea
                                    class="form-control border-secondary-subtle"
                                    id="inputAddress" name="address2"
                                    placeholder="Địa chỉ cụ thể"></textarea>
                            </div>

                            <div class="form-check mt-3 mx-3">
                                <input class="form-check-input border-secondary-subtle mt-1" type="checkbox" value=""
                                    id="flexCheckChecked" required>
                                <label class="form-check-label" for="flexCheckChecked">
                                    <a href="">Tôi đồng ý với các điều khoản</a>
                                </label>
                            </div>
                            
                            <div class="col-12 my-4 text-end">
                                <button type="submit"
                                    class="btn mx-2 btn-dark rounded-0 text-white w-100">Xác
                                    nhận thanh toán</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection