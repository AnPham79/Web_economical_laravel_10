@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center">Tạo lại mật khẩu</h1>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('reset-password') }}">
                @csrf
                <div class="form-group mt-3">
                    <label for="token">Nhập mã Code</label>
                    <input type="text" id="token" name="token" class="form-control border-secondary-subtle mt-2" required>
                </div>
                <div class="form-group mt-3">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" id="password" name="password" class="form-control border-secondary-subtle mt-2" required>
                </div>
                <div class="form-group mt-3">
                    <label for="password_confirmation">Nhập lại mật khẩu mới</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control border-secondary-subtle mt-2" required>
                </div>
                <button type="submit" class="btn btn-dark rounded-0 mt-3 float-end btn-block">Reset Password</button>
            </form>
        </div>
    </div>
</div>
@endsection