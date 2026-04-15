<x-cay-canh-layout>
    <x-slot name="title">Giỏ hàng của bạn</x-slot>

    <div class="container mt-4 mb-5">
        <h4 class="text-center mb-4" style="color: #0056b3; font-weight: bold; text-transform: uppercase;">Danh sách sản phẩm</h4>

        @if(count($products) > 0)
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <table class="table table-bordered text-center align-middle bg-white shadow-sm">
                        <thead>
                            <tr>
                                <th style="width: 5%;">STT</th>
                                <th class="text-left" style="width: 45%;">Tên sản phẩm</th>
                                <th style="width: 15%;">Số lượng</th>
                                <th style="width: 20%;">Đơn giá</th>
                                <th style="width: 15%;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $stt = 1; @endphp
                            @foreach($products as $sp)
                            <tr>
                                <td>{{ $stt++ }}</td>
                                <td class="text-left">{{ $sp->ten_san_pham }}</td>
                                <td>{{ $cart[$sp->id] }}</td>
                                <td>{{ number_format($sp->gia_ban, 0, ',', '.') }}đ</td>
                                <td>
                                    <a href="{{ route('cart.remove', $sp->id) }}" class="btn btn-sm text-white" style="background-color: #dc3545;">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                            
                            <tr style="background-color: #f8f9fa;">
                                <td colspan="3" class="text-center font-weight-bold" style="font-size: 16px;">Tổng cộng</td>
                                <td colspan="2" class="text-left font-weight-bold" style="font-size: 16px;">
                                    {{ number_format($totalPrice, 0, ',', '.') }}đ
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <form action="{{ route('cart.checkout') }}" method="POST" class="text-center mt-4">
                        @csrf
                        <div class="form-group d-flex flex-column align-items-center">
                            <label class="font-weight-bold" style="font-size: 15px;">Hình thức thanh toán</label>
                            <select name="hinh_thuc" class="form-control text-center mt-1" style="width: 250px;">
                                <option value="Tiền mặt">Tiền mặt</option>
                                <option value="Chuyển khoản">Chuyển khoản</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn text-white mt-3 px-4 py-2" style="background-color: #007bff; border-radius: 4px; font-weight: bold;">
                            ĐẶT HÀNG
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center mt-5 mb-5 p-5 bg-white shadow-sm rounded">
                <h5 class="text-muted mb-3">Giỏ hàng của bạn đang trống!</h5>
                <a href="/" class="btn btn-success">Tiếp tục mua sắm</a>
            </div>
        @endif
    </div>
</x-cay-canh-layout>