@extends('layouts.master')

@section('content')
    <main>
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item">
                        Giới thiệu
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <img src="{{ asset('img/me/aboutus.jpg') }}" class="w-100" alt="Ảnh của bạn" class="img-fluid">
                </div>
                <div class="col-lg-6 mt-4">
                    <h2>Chào mừng đến với trang giới thiệu của BAOAN STORE!</h2>
                    <p>Xin chào! Tôi là đại diện của BAOAN STORE, một người đam mê về
                        thời trang. Tôi đã dành nhiều thời gian để
                        tìm hiểu và phát triển kỹ năng của mình trong lĩnh
                        vực này, và tôi rất vui được chia sẻ những kiến thức
                        và kinh nghiệm của mình thông qua trang web này.</p>
                    <p>Bên cạnh việc làm [nghề nghiệp của bạn], tôi cũng yêu
                        thích [một hoặc vài sở thích hoặc sở đam mê khác của
                        bạn]. Trong thời gian rảnh rỗi, bạn có thể tìm thấy
                        tôi [hoạt động, sở thích, hoặc sở đam mê khác của
                        bạn].</p>
                    <p>Trong trang giới thiệu này, bạn sẽ tìm thấy những
                        thông tin chi tiết về cuộc sống, công việc và sở
                        thích của tôi. Hy vọng bạn sẽ tìm thấy những điều
                        thú vị và hữu ích. Nếu có bất kỳ câu hỏi nào hoặc
                        muốn kết nối, đừng ngần ngại liên hệ với tôi!</p>
                    <p>Cảm ơn bạn đã ghé thăm trang web của tôi!</p>
                    <p>Trân trọng,</p>
                    <p>[Tên của bạn]</p>
                </div>
            </div>
        </div>
    </main>
@endsection
