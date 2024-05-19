<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Register
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-edit h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                style="background-image: url('{{ asset('img/Auth/banner_regis.jpg') }}'); background-size: cover;">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                            <div class="card card-plain">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder">Đăng kí</h4>
                                    <p class="mb-0">Hãy nhập đủ các thông tin để đăng kí thành công nhé !!!</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('handle-register') }}" class="text-start">
                                        @csrf
    
                                        @if ($errors->any())
                                            <div class="alert alert-danger text-white">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if(session()->has('register_data'))
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="name" value="{{ session('register_data')['name'] }}" placeholder="Nhập tên của bạn ...">
                                            </div>
                                            <div class="mb-3">
                                                <input type="email" class="form-control" name="email" value="{{ session('register_data')['email'] }}" placeholder="Nhập email của bạn ...">
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control" name="avatar" value="{{ session('register_data')['avatar'] }}" placeholder="avatar">
                                            </div>
                                        @else
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nhập tên của bạn ...">
                                                {{-- @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror --}}
                                            </div>
        
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Nhập email của bạn ...">
                                                {{-- @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror --}}
                                            </div>
        
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu của bạn ...">
                                                {{-- @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror --}}
                                            </div>
                                        @endif
    
                                        <div class="form-group d-flex py-3">
                                            <div class="form-check form-check-info text-start ps-0">
                                                <input class="form-check-input" type="radio" value="1" name="gender" {{ old('gender') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    <span class="text-dark font-weight-bolder">Nam</span>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-info text-start ps-0 mx-2">
                                                <input class="form-check-input" type="radio" value="2" name="gender" {{ old('gender') == '2' ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    <span class="text-dark font-weight-bolder">Nữ</span>
                                                </label>
                                            </div>
                                        </div>
    
                                        <div class="form-check form-check-info text-start ps-0">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Tôi đồng ý <a href="" class="text-dark font-weight-bolder">Các điều khoản dịch vụ</a>
                                            </label>
                                        </div>
    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg bg-gradient-edit btn-lg w-100 mt-4 mb-0">Đăng kí</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-2 text-sm mx-auto">
                                        bạn đã có tài khoản ?
                                        <a href="{{ route('login') }}" class="text-success text-gradient-edit font-weight-bold">Đăng nhập</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>    
    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-dashboard.min.js?v=3.1.0') }}"></script>
</body>

</html>