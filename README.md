<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

// tạo thư mục service bằng cách chạy lệnh mkdir app\Services

// tải redis bằng cách composer require predis/predis

Mô tả trang web
Giao diện người dùng
--------------------------------------------------------------------------------------------------------------------------------------
- menu:
  + Đường dẫn đến các trang liên hệ, sản phẩm, giới thiệu, đăng kí đăng nhập, giỏ hàng, sản phẩm giảm giá
  + Thanh search ( sử dụng view composer để thanh search có thể search được ở bất cứ đâu )
- trang chủ:
  + Các trang con như trang sản phẩm, liên hệ, giới thiệu
  + section sản phẩm gồm 4 sản phẩm mới nhất được thêm ( được xem là sản phẩm mới khi đã thêm mới trong vòng 15 ngày kể từ ngày tạo ).
  + section sản phẩm giảm giá gồm 4 sản phẩm có phần trăm giảm giá.
- Trang sản phẩm
  + lọc sản phẩm theo ( giá min, giá max, sale, tìm kiếm theo tên ),
  + lọc sản phẩm theo danh mục.
  + phân trang
  + validate
- Trang sản phẩm giảm giá
  + tìm kiếm sản phẩm.
  + lọc sản phẩm theo giá min, giá max.
  + Tìm kiếm sản phẩm.
  + validate
  + Sử dụng scope cho các phần tìm kiếm để tối ưu hiệu xuất.
- Trang giỏ hàng
  + Quản lí giỏ hàng ( Tăng giảm số lượng , xóa tất cả sản phẩm được chọn )
  + Xóa tất cả sản phẩm trong giỏ hàng
  + Sản phẩm có size khác nhau nhưng cùng loại sản phẩm vẫn phải tách ra.
  + Áp mã giảm giá.
- Đăng kí đăng nhập
  + Đăng nhập bằng google và github nếu đã có sản phẩm rồi thì chuyển vào trang chủ còn nếu chưa có thì chuyển đến đăng kí
  + Quên mật khẩu, nhập lại email để nhận mã token
  + Nhập toke để đổi lại mật khẩu mới
  + Validate
  + Gửi mail chào mừng khi lần đầu tiên đăng kí tài khoản bằng (event listener, sử dụng queue để tối ưu hiệu xuất)
- Chi tiết sản phẩm
  + Chọn size khi thêm vào giỏ hàng
  + tăng giảm số lượng
  + bình luận đánh giá sản phẩm ( số sao của sản phẩm sẽ được tính trung bình từ tất cả các đánh giá khác của người dùng )
  + Sử dụng Cache để lưu thông tin sản phẩm khi lần đầu tiên người dùng nhấn vào sản phẩm ( Giảm tải các câu query, tối ưu hóa hiệu xuất trang web ).
- Thanh toán
  + sau khi thanh toán thì hóa đơn sẽ được chuyển về Mail ( Queue )
  + Đơn hàng sẽ được nằm ở trong profile của người mua và sẽ được cung cấp 1 mã khi mail về đơn hàng để tìm kiếm đơn dễ hơn
  + cập nhật hủy đơn khi người bán chưa xác nhận
    
Giao diện admin
-----------------------------------------------------------------------------------------------------------------------------------------
- navbar gồm tất cả các phần
  + Quản lí sản phẩm
  + Quản lí Hóa đơn
  + Quản lí Bình luận
  + Quản lí tài khoản
  + Quản lí Danh mục
  + Quản lí mã giảm giá
  + Quản lí size sản phẩm
  + Quản lí ảnh nhỏ sản phẩm
  + Quản lí địa chỉ giao hàng
- Quản lí sản phẩm
  + CDUD sản phẩm, import, export excel CSV
- Quản lí hóa đơn
  + cập nhật trạng thái đơn hàng
  + xem chi tiết đơn hàng
- Quản lí bình luận
  + Xem bình luận, ẩn bình luận
- Quản lí tài khoản
  + Khóa tài khoản
- Quản lí danh mục
  + CRUD cho danh mục ( observer )
.....
- Chart
  + Xem thống kê các sản phẩm được mua nhìu
