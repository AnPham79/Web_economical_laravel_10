@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center">Quên mật khẩu</h1>
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('forgot-password') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Nhập email của bạn</label>
                    <input type="email" id="email" name="email" class="form-control border-secondary-subtle mt-2" required>
                </div>
                <button type="submit" class="btn btn-dark rounded-0 mt-3 float-end btn-block">Gửi mã</button>
            </form>
        </div>
    </div>
</div>
@endsection
