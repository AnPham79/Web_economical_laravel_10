@extends('layouts.master')

@section('content')
    <main>
        <!-- ------------------------------------- banner product page -------------------------------------------------- -->
        <div class="banner-product-page">
            <img src="{{ asset('img/banner-product-page.jpg') }}" class="w-100" alt>
        </div>
        <!-- -------------------------------------- end banner product page ---------------------------------------------- -->

        <!-- ------------------------- nội dung danh mục ------------------------------------------------------- -->
        <div class="article my-5">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item">
                            Tất cả sản phẩm giảm giá
                        </li>
                    </ol>
                </nav>
                <div class="row mt-5">
                    <div class="col-lg-2 col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                <h2 class="fs-5 fw-bold" style="margin-bottom: 0;">DANH MỤC</h2>
                                <ul class="list-unstyled mt-3">
                                    <li class="my-2">
                                        <i class='bx bx-chevron-right' style="transform: translateY(1px);"></i>
                                        <a href="{{ route('product-sale-page') }}" class="text-decoration-none text-dark">
                                            Tất cả
                                        </a>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li class="my-2" id="categories-select">
                                            <i class='bx bx-chevron-right' style="transform: translateY(1px);"></i>
                                            <a href="{{ route('category-products-sale', ['slug' => $category->category_slug_name]) }}" class="text-decoration-none text-dark" onchange="this.click()">
                                                {{ $category->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-8 col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h2 class="fs-5 fw-bold" style="margin-bottom: 0;">TẤT CẢ SẢN
                                    PHẨM GIẢM GIÁ
                                </h2>
                            </div>
                        </div>
                        <div class="section mt-5">
                            <div class="list-product">
                                <div class="row" id="search_list">
                                    @foreach ($products as $product)
                                        <div class="col-lg-3 col-md-4">
                                            <div class="product">
                                                <div class="product-img">
                                                    <img src="{{ asset('img/product') }}/{{ $product->product_image }}.jpg"
                                                        class="w-100" alt>
                                                    <a
                                                        href="{{ route('product-detail', ['slug' => $product->product_slug_name]) }}">
                                                        <div class="over-lay">
                                                            <button>Xem thêm</button>
                                                        </div>
                                                    </a>
                                                    @if ($product->product_percent_sale > 0)
                                                        <div class="sale-title">
                                                            <span>{{ number_format($product->product_percent_sale) }}%</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="product-name text-center py-2 fw-bold"
                                                    style="font-size: 15px; color: gray;">
                                                    <a
                                                        href="{{ route('product-detail', ['slug' => $product->product_slug_name]) }}">{{ $product->product_name }}</a>
                                                </div>
                                                <div class="product-price text-center py-2 fw-bold">
                                                    @if ($product->product_percent_sale > 0)
                                                        @php
                                                            $price_sale =
                                                                $product->product_regular_price *
                                                                (1 - $product->product_percent_sale / 100);
                                                        @endphp
                                                        <p class="text-secondary"
                                                            style="margin-bottom: 0; text-decoration: line-through; font-size:13px">
                                                            {{ number_format($product->product_regular_price) }}đ</p>
                                                        <p style="margin-bottom: 0;">{{ number_format($price_sale) }}đ</p>
                                                    @else
                                                        <p style="margin-bottom: 0;">
                                                            {{ number_format($product->product_regular_price) }}đ</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- --------------------------- kết thúc phân trang -------------------------------  -->
                </div>
            </div>
        </div>
        <!-- -------------------------- end nội dung danh mục -------------------------------------------------- -->
    </main>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script>
        document.getElementById('orderBySelect').addEventListener('change', function() {
            var selectedValue = this.value;
            var currentUrl = window.location.href;
            var baseUrl = currentUrl.split('?')[0];
            var newUrl = baseUrl + '?orderBy=' + selectedValue;
            window.history.pushState({path: newUrl}, '', newUrl);
            window.location.reload();
        });
        // $document.ready(function() {
        //     $('#search').on('keyup', function() {
        //         var query = $this.val();
        //         $.ajax({
        //             url: "search",
        //             method: 'GET',
        //             data: {'search': query},
        //             success: function(data) {
        //                 $('#search_list').html(data);
        //             }
        //         })
        //     })
        // })

    </script>
    
@endsection