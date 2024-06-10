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
                                        <h2 class="fw-bold">Quản lí người dùng</h2>
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
                                        <th>Tên người dùng</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center text-center">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <p>{{ $user->name }}</p>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address ?? 'chưa cung cấp' }}</td>
                                            <td>{{ $user->mobile ?? 'chưa cung cấp' }}</td>
                                            <td>
                                                @if($user->status == 'is_active')
                                                    <form action="{{ route('change-status-account', ['user_name' => $user->name]) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-danger">Khóa</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('change-status-account', ['user_name' => $user->name]) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-success">Mở khóa</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection