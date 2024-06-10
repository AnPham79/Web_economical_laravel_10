@extends('admin.layouts.master')

@section('content')
    <main>
        <div>
            <style>
                nav svg {
                    height: 20px;
                }

                nav .hidden {
                    display: block !important;
                }
            </style>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="fw-bold">Quản lí Đơn hàng</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success text-white" role="alert">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <table class="table table-triped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Người mua</th>
                                        <th>Tiền tạm thời</th>
                                        <th>Mã giảm giá</th>
                                        <th>Tổng tiền</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Thời gian mua</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Xem chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ number_format($item->sub_total) }} VND</td>
                                            <td>
                                                @if($item->discount)
                                                   {{ $item->discount }}
                                                @else
                                                    <span class="text-danger">Không dùng</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->total) }} VND</td>
                                            <td>{{ $item->order_code }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>
                                                <form action="{{ route('update-order-status', ['id' => $item->id]) }}" method="POST">
                                                    @csrf
                                                    <select name="status_order" onchange="this.form.submit()">
                                                        <option value="Placed" {{ $item->status_order == 'Placed' ? 'selected' : '' }}>Chờ xác nhận</option>
                                                        <option value="Confirmed" {{ $item->status_order == 'Confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                                        <option value="Processing" {{ $item->status_order == 'Processing' ? 'selected' : '' }}>Đang xử lý</option>
                                                        <option value="Shipped" {{ $item->status_order == 'Shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                                                        <option value="Delivered" {{ $item->status_order == 'Delivered' ? 'selected' : '' }}>Đã giao</option>
                                                        <option value="Cancelled" {{ $item->status_order == 'Cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('order-manager-detail', ['id' => $item->id]) }}">
                                                    Chi tiết đơn hàng
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection