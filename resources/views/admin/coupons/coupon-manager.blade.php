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
                                        <h2 class="fw-bold">Quản lí mã giảm giá</h2>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <a href="{{ route('create-coupon-manager') }}" class="btn btn-success float-end mx-1">
                                            Thêm mới
                                        </a>
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
                            <table class="table table-triped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Mã</th>
                                        <th>Kiểu</th>
                                        <th>Giá trị</th>
                                        <th>Giá trị giỏ hàng tối thiểu</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center text-center">
                                    @foreach ($coupons as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <p>{{ $item->code }}</p>
                                            </td>
                                            <td>
                                                @if($item->type == 'percent')
                                                    <span>Phần trăm</span>
                                                @else
                                                    <span>Giá cứng</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->type == 'percent')
                                                    <span>{{ number_format($item->coupon_value) }}</span>%
                                                @else
                                                    <span>{{ number_format($item->coupon_value) }}</span> VND
                                                @endif
                                            </td>
                                            <td>
                                                <p>{{ number_format($item->cart_value) }} VND</p>
                                            </td>
                                            <td id="deleteForm" class="d-flex justify-content-center">
                                                <a href="{{ route('edit-coupon-manager', $item->id) }}"><i class="fa-solid fa-pen-to-square text-info"></i></i></a>
                                               
                                                <form action="{{ route('destroy-coupon-manager', $item->id ) }}" method="POST" id="delete-product{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="border-0 bg-light mx-1"><i class="fa-solid fa-trash text-danger"></i></button>
                                                </form>
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