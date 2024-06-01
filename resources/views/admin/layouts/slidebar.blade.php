<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">

    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center"
            href="{{ route('index') }}" target="_blank">
            <span class="ms-1 font-weight-bold text-white">BAOAN STORE</span>
        </a>
    </div>


    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('product.product-manager') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-brands fa-product-hunt fs-5"></i>
                    </div>

                    <span class="nav-link-text ms-1">Quản lí sản phẩm</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('category.category-manager') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-list fs-5"></i>
                    </div>

                    <span class="nav-link-text ms-1">Quản lí danh mục</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-white " href="">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user fs-5"></i>
                    </div>

                    <span class="nav-link-text ms-1">Quản lí người dùng</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-box fs-5"></i>
                    </div>

                    <span class="nav-link-text ms-1">Quản lí đơn hàng</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-chart-simple fs-5"></i>
                    </div>

                    <span class="nav-link-text ms-1">Thống kê</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-brands fa-salesforce fs-5"></i>
                    </div>

                    <span class="nav-link-text ms-1">Quản lí mã giảm giá</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('size.product-manager.index') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-font fs-5"></i>
                    </div>

                    <span class="nav-link-text ms-1">Quản lí size</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-image fs-5"></i>
                    </div>

                    <span class="nav-link-text ms-1">Quản lí banner</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>


            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('logout') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>

                    <span class="nav-link-text ms-1">Đăng xuất</span>
                </a>
            </li>

        </ul>
    </div>

</aside>