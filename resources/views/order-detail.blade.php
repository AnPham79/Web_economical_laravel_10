@extends('layouts.master')

@section('content')
    <div>
        <style>
            nav svg {
                height: 20px;
            }

            nav .hidden {
                display: block !important;
            }
            .text-danger {
            color: red;
            }

            .text-success {
                color: green;
            }
            .text-info {
                color: blue;
            }
            .text-warning {
                color: orange;
            }
            
        </style>
        <div class="container" style="padding:30px 0px">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="col-md-6">
                                <h2 class="fw-bold">Chi tiết đơn hàng</h2>
                            </div>
                            <div class="col-md-6 float-end">
                                <a href="{{ route('order-history') }}" class="btn btn-dark rounded-0 float-end mx-1"
                                    style="transform: translateY(-40px);">Quay lại</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->product->product_name }}</td>
                                            <td><img src="{{ asset('img/product') }}/{{ $product->product->product_image }}"
                                                    class="" style="height: 100px" alt></td>
                                            <td>{{ number_format($product->unit_price) }} VND</td>
                                            <td>{{ number_format($product->quantity) }}</td>
                                            <td>{{ number_format($product->totalUnit) }} VND</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="padding: 30px 0px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="fw-bold">Địa chỉ giao hàng</h2>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body mt-5">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <table class="table table-tripped">
                                <thead>
                                    <tr>
                                        <th>Tên người mua</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Tỉnh</th>
                                        <th>Thành phố</td>
                                        <th>Xã/Huyện</th>
                                        <th>Địa chỉ cụ thể</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $shipping->user_name }}</td>
                                        <td>{{ $shipping->phone_number }}</td>
                                        <td>{{ $shipping->email }}</td>
                                        <td>{{ $shipping->province }}</td>
                                        <td>{{ $shipping->city }}</td>
                                        <td>{{ $shipping->commune }}</td>
                                        <td>{{ $shipping->address2 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($product->order->status_order == 'Placed')
            <div class="container">
                <form action="{{ route('cancel-order', ['status' => $product->order->status_order]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-danger w-100 rounded-0">Hủy đơn</button>
                </form>
            </div>
        @else
            <p class="text-center {{ $product->order->status_order == 'Cancelled' ? 'text-danger' : 'text-success' }}">
                @switch($product->order->status_order)
                    @case('Confirmed')
                        Đơn hàng của bạn đã xác nhận
                    @break

                    @case('Processing')
                        Đơn hàng của bạn đang được xử lý
                    @break

                    @case('Shipped')
                        Đơn hàng của bạn đã được giao hàng
                    @break

                    @case('Delivered')
                        Đơn hàng của bạn đã được giao
                    @break

                    @case('Cancelled')
                        Đơn hàng của bạn đã bị hủy
                    @break

                    @default
                        Trạng thái đơn hàng: {{ $product->order->status_order }}
                @endswitch
            </p>
        @endif
    </div>
@endsection
