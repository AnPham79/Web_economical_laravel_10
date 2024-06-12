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
                                        <h2 class="fw-bold">Quản lí bình luận</h2>
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
                                        <th>Tên người bình luận</th>
                                        <th>Sản phẩm được bình luận</th>
                                        <th>Đánh giá</th>
                                        <th>Ngày bình luận</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center text-center">
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            <td>
                                                <p>{{ $comment->user->name }}</p>
                                            </td>
                                            <td>{{ $comment->product->product_name }}</td>
                                            <td>{{ $comment->rating }} <i class="fa-solid fa-star text-warning"></i></td>
                                            <td>{{ $comment->created_at->diffForHumans() }} sao</td>
                                            <td>
                                                @if($comment->status == 'is_show')
                                                    <form action="{{ route('change-status-comment', ['id' => $comment->id]) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-danger">Ẩn</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('change-status-comment', ['id' => $comment->id]) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-success">Hiện</button>
                                                    </form>
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
    </main>
@endsection