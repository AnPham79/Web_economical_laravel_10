@extends('layouts.master')

@section('content')
    <style>
        .container {
            margin-top: 50px;
        }

        .btn-google:hover {
            background-color: red;
            color: white !important;
        }

        .or {
            font-weight: bold;
        }
    </style>

    <main>
        <div class="container" style="padding-top: 60px; max-width: 1000px;">
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <img src="{{ asset('img/Auth/banner_login.png') }}" class="w-100" alt="">
                </div>

                <div class="col-md-6">
                    <form role="form" method="POST" action="{{ route('handle-login') }}">
                        @csrf
                        <h1 class="bold text-center mb-5">Đăng nhập</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger text-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group mt-3">
                            <label for="email" class="label-control">Địa chỉ email</label>
                            <input type="email" name="email"
                                class="form-control border border-secondary-subtle mt-1 rounded-0"
                                placeholder="Nhập địa chỉ email của bạn" value="{{ old('email') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="password" class="label-control">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password"
                                    class="form-control border border-secondary-subtle rounded-0"
                                    placeholder="Nhập mật khẩu của bạn">
                                <div class="input-group-append">
                                    <button class="btn btn-dark rounded-0" type="button"
                                        onclick="togglePassword()">Hiện</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-lmao d-flex justify-content-between">
                            <div class="form-check mt-3">
                                <input class="form-check-input border-secondary-subtle mt-1" type="checkbox" value=""
                                    id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Nhắc nhỡ tôi
                                </label>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('forgot-password') }}">Quên mật khẩu</a>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button class="rounded-0 btn btn-dark w-100" type="submit">Đăng nhập ngay</button>
                        </div>

                    </form>
                    <div class="or">
                        <p class="text-center my-3">Hoặc</p>
                    </div>
                    <div class="button-social">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('github-auth') }}">
                                    <button class="btn btn-dark rounded-0 w-100">
                                        <i class="fa-brands fa-github"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('google-auth') }}">
                                    <button class="btn-google btn btn-light border-danger rounded-0 w-100 text-danger">
                                        <i class="fa-brands fa-google"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="exist_accout mt-4 text-center">
                        <p>Bạn chưa có tài khoản ? <a href="{{ route('register') }}">đăng kí ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        function togglePassword() {
            var password = document.getElementById('password');
            var toggleButton = document.getElementById('toggleButton');

            if (password.type === "password") {
                password.type = "text";
                toggleButton.textContent = "Ẩn";
            } else {
                password.type = "password";
                toggleButton.textContent = "Hiện";
            }
        }
    </script>
@endsection
