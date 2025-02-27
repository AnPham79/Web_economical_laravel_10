@extends('layouts.master')

@section('content')
    <div>
        <style>
            nav svg {
                height: 20px;
            }

            .text-danger {
                color: red;
            }

            .text-success {
                color: green;
            }
    
            nav .hidden {
                display: block !important;
            }
        </style>
        <div class="container" style="padding:30px 0px">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading mt-5">
                            <h2 class="fw-bold">Lịch sử mua hàng</h2>
                            <form action="" method="GET" class="form-inline my-5 d-flex">
                                <input value="{{ $search ?? '' }}" type="text" name="order_code" class="form-control border border-secondary-subtle rounded-0" placeholder="Nhập mã đơn hàng">
                                <button type="submit" class="btn btn-dark rounded-0 ml-2 px-4">Tìm</button>
                            </form>                            
                        </div>
                        <div class="panel-body mt-4">
                            @if (Session::has('message'))
                                <div class="alert aler-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <table class="table table-triped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Người mua</th>
                                        <th>Mã giảm giá</th>
                                        <th>Tổng tiền</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Thời gian mua</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Xem chi tiết</th>
                                        <th>Cập nhật trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>
                                                @if($item->discount)
                                                    {{ $item->discount }}
                                                @else
                                                    <span class="text-danger"> Không dùng </span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->total) }} VND</td>
                                            <td>{{ $item->order_code }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td class="{{ $item->status_order == 'Cancelled' ? 'text-danger' : 'text-success' }}">
                                                @switch($item->status_order)
                                                    @case('Placed')
                                                        Chờ xác nhận
                                                        @break
                                                    @case('Confirmed')
                                                        Đã xác nhận
                                                        @break
                                                    @case('Processing')
                                                        Đang xử lý
                                                        @break
                                                    @case('Shipped')
                                                        Đã giao hàng
                                                        @break
                                                    @case('Delivered')
                                                        Đã giao
                                                        @break
                                                    @case('Cancelled')
                                                        Đã hủy
                                                        @break
                                                    @default
                                                        {{ $item->status_order }}
                                                @endswitch
                                            </td>
                                            <td>
                                                <a href="{{ route('order-detail', ['id' => $item->id]) }}">
                                                    Chi tiết đơn hàng
                                                </a>
                                            </td>
                                            <td>
                                                @if($item->status_order == 'Placed')
                                                    <form action="{{ route('cancel-order', ['id' => $item->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger rounded-0">Hủy đơn</button>
                                                    </form>
                                                @else
                                                    <button disabled class="btn btn-secondary rounded-0">Hủy đơn</button>
                                                @endif
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
    </div>
@endsection