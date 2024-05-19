@extends('layouts.master')

@section('content')
<main>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                <li class="breadcrumb-item">
                    Liên hệ
            </ol>
        </nav>
        <h2 class="mt-5">Liên hệ với chúng tôi</h2>
        <div class="row">
            <!-- Biểu mẫu liên hệ -->
            <div class="col-md-6">
                <form class="mt-3">
                    <div class="form-group my-4">
                        <label for="name">Họ và tên:</label>
                        <input type="text" class="form-control mt-2 border-primary-subtle" id="name" required>
                    </div>
                    <div class="form-group my-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control mt-2 border-primary-subtle" id="email" required>
                    </div>
                    <div class="form-group my-4">
                        <label for="message">Nội dung:</label>
                        <textarea class="form-control mt-2 border-primary-subtle" id="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark rounded-0">Gửi</button>
                </form>
            </div>
            <!-- Bản đồ -->
            <div class="col-md-6 mt-sm-5">
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d737.6538270179932!2d106.63159723703146!3d10.855436911407223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529b5f8396e0d%3A0x91dc89134d9e6807!2zTmjDoCB0cuG7jSBzaW5oIHZpw6puIGtodSBwaOG7kSAx!5e0!3m2!1svi!2s!4v1716028399598!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection