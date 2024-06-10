@extends('admin.layouts.master')

@section('content')

    <div class="container" style="padding: 140px 0px">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="panel panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="fw-bold">Thêm mã giảm giá</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('coupon-manager') }}" class="btn btn-success float-end">Quản lý mã giảm giá</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger text-white">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('store-coupon-manager') }}" 
                        class="form-horizontal"  method="POST">
                        @csrf
                        <div class="form-group row my-2">
                            <label for="" class="col-md-4 control-label fw-bold">Nhập tên mã giảm giá</label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Nhập tên mã giảm giá" name="code"
                                    class="form-control input-md border border-secondary px-2" value="{{ old('code') }}"/>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="" class="col-md-4 control-label fw-bold">Chọn kiểu</label>
                            <div class="col-md-8">
                                <select name="type" id="type" class="form-select border border-secondary px-2">
                                    <option value="percent">Phần trăm</option>
                                    <option value="fixed">Giá cố định</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="" class="col-md-4 control-label fw-bold">Nhập giá trị của mã</label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Nhập giá trị của mã" name="coupon_value"
                                    class="form-control input-md border border-secondary px-2" value="{{ old('coupon_value') }}"/>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="" class="col-md-4 control-label fw-bold">Nhập giá trị tối thiểu của giỏ hàng</label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Nhập giá trị tối thiểu của giỏ hàng" name="cart_value"
                                    class="form-control input-md border border-secondary px-2" value="{{ old('cart_value') }}"/>
                            </div>
                        </div>

                        <div class="form-group my-2">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-success float-end" type="Submit">Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection