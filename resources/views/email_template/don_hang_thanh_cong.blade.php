<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif; /* Hỗ trợ hiển thị tiếng Việt tốt hơn trong PDF/Email */
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
        }
        .order-info {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
        }
        .total {
            font-weight: bold;
            color: #d9534f;
            font-size: 1.2em;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #0056b3;">XÁC NHẬN ĐƠN HÀNG THÀNH CÔNG</h2>
        </div>

        <p>Chào bạn,</p>
        <p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi. Dưới đây là chi tiết đơn hàng của bạn:</p>

        <div class="order-info">
            <p><strong>Hình thức thanh toán:</strong> {{ $data['hinh_thuc'] }}</p>
            
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $stt = 1; $total = 0; @endphp
                    @foreach($data['products'] as $sp)
                        @php 
                            $quantity = $data['cart'][$sp->id];
                            $subtotal = $sp->gia_ban * $quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $stt++ }}</td>
                            <td style="text-align: left;">{{ $sp->ten_san_pham }}</td>
                            <td>{{ $quantity }}</td>
                            <td>{{ number_format($sp->gia_ban, 0, ',', '.') }}đ</td>
                            <td>{{ number_format($subtotal, 0, ',', '.') }}đ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                        <td class="total">{{ number_format($total, 0, ',', '.') }}đ</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <p>Chúng tôi sẽ sớm liên hệ với bạn để xác nhận thời gian giao hàng.</p>

        <div class="footer">
            <p>Đây là email tự động, vui lòng không phản hồi email này.</p>
            <p>&copy; 2026 Cửa Hàng Cây Cảnh - HUB</p>
        </div>
    </div>
</body>
</html>