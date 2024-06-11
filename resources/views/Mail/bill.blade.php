<!DOCTYPE html>
<html>
<head>
    <title>Hóa đơn</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Xác nhận đơn hàng - {{ $order->order_code }}</h1>
        <p>Cảm ơn bạn đã đặt hàng.</p>

        <h2 class="mt-4">Chi tiết đơn hàng</h2>
        <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng giá mỗi sản phẩm</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->product_name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price) }} VND</td>
                        <td>{{ number_format($detail->totalUnit) }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-4">Số tiền giảm do mã giảm giá: {{ number_format($detail->discount_price) }} VND</h2>

        <h2 class="mt-4">Tổng giá: {{ number_format($detail->order->total) }} VND</h2>

        <i class="text-secondary">Bạn hãy coppy mã đơn hàng để tìm kiếm đơn hàng của mình dễ hơn nhé.</i>
    </div>
</body>
</html>