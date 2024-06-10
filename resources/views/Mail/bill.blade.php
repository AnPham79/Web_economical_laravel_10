<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng tiền</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($orderDetail as $product)
            <tr>
                <td>{{ $product->product->product_name }}</td>
                <td><img src="{{ asset('img/product') }}/{{ $product->product->product_image }}"
                        class="" style="height: 100px" alt></td>
                <td>{{ number_format($product->unit_price) }} VND</td>
                <td>{{ number_format($product->quantity) }}</td>
                <td>{{ number_format($product->totalUnit) }} VND</td>
            </tr>
        @endforeach
    </tbody>
</table>