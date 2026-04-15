<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Thư viện để lấy email người dùng đăng nhập
use Illuminate\Support\Facades\Mail; // Thư viện để gửi Mail
use App\Mail\CheckoutSuccessMail;    // Import class Mail bạn vừa tạo

class Controller3 extends Controller
{
    // 1. Hiển thị trang giỏ hàng
    public function giohang()
    {
        // Lấy giỏ hàng từ Session (Nếu trống thì gán mảng rỗng)
        $cart = session()->get('cart', []);
        
        // Lấy danh sách các ID sản phẩm đang có trong giỏ
        $productIds = array_keys($cart);
        
        // Truy vấn DB lấy thông tin sản phẩm
        $products = DB::table('san_pham')->whereIn('id', $productIds)->get();

        // Tính tổng tiền
        $totalPrice = 0;
        foreach ($products as $sp) {
            $totalPrice += $sp->gia_ban * $cart[$sp->id];
        }

        // Trả về file giao diện giohang.blade.php
        return view('caycanh.giohang', compact('products', 'cart', 'totalPrice'));
    }

    // 2. Xóa 1 sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        // Xóa phần tử khỏi mảng Session
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->save(); // Ép lưu Session ngay lập tức
        }

        return redirect()->back(); // Load lại trang giỏ hàng hiện tại
    }

    // 3. Xử lý khi nhấn nút ĐẶT HÀNG (Đã tích hợp gửi Mail)
    public function checkout(Request $request)
    {
        // Lấy giỏ hàng hiện tại
        $cart = session()->get('cart', []);

        // Nếu giỏ hàng trống mà cố tình bấm đặt hàng thì báo lỗi
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // --- BƯỚC 1: CHUẨN BỊ DỮ LIỆU ĐỂ GỬI VÀO EMAIL ---
        $productIds = array_keys($cart);
        $products = DB::table('san_pham')->whereIn('id', $productIds)->get();
        
        $cartDetails = [];
        $totalPrice = 0;

        foreach ($products as $sp) {
            $sp->so_luong = $cart[$sp->id]; // Đính kèm số lượng người dùng mua
            $cartDetails[] = $sp;           // Đưa vào mảng chi tiết
            $totalPrice += $sp->gia_ban * $sp->so_luong;
        }

        // --- BƯỚC 2: TIẾN HÀNH GỬI MAIL ---
        // Lấy email của người đang đăng nhập
        $userEmail = Auth::user()->email;

        // Bắn email đi (Gửi kèm chi tiết giỏ hàng và tổng tiền)
        Mail::to($userEmail)->send(new CheckoutSuccessMail($cartDetails, $totalPrice));

        // --- BƯỚC 3: DỌN DẸP VÀ CHUYỂN HƯỚNG ---
        // Xóa sạch giỏ hàng
        session()->forget('cart');
        session()->save();

        // Chuyển hướng về Trang chủ và gửi kèm 1 thông báo thành công
        return redirect('/')->with('checkout_success', 'Đặt hàng thành công! Vui lòng kiểm tra hóa đơn trong Email của bạn.');
    }
}