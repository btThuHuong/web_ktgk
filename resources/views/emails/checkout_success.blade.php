<!DOCTYPE html>
<html>
<head>
    <title>Đặt hàng thành công</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2 style="color: #2f5d3a;">Cảm ơn bạn đã đặt hàng!</h2>
    <p>Xin chào,</p>
    <p>Đơn hàng của bạn đã được ghi nhận thành công. Dưới đây là thông tin thanh toán:</p>
    
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartDetails as $item)
            <tr>
                <td>{{ $item->ten_san_pham }}</td>
                <td style="text-align: center;">{{ $item->so_luong }}</td>
                <td style="text-align: right;">{{ number_format($item->gia_ban, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align: right;">Tổng cộng:</th>
                <th style="color: red; text-align: right;">{{ number_format($totalPrice, 0, ',', '.') }}đ</th>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top: 20px;">Chúng tôi sẽ sớm liên hệ với bạn để giao hàng.</p>
    <p>Trân trọng,<br><b>Cửa hàng Cây Cảnh</b></p>
</body>
</html>