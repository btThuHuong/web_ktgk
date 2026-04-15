<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller2 extends Controller
{
    // 1. Hàm hiển thị trang chi tiết
    public function chitiet($id)
    {
        // Lấy dữ liệu sản phẩm theo id
        $sanpham = DB::table('san_pham')->where('id', $id)->first();
        
        return view('caycanh.chitiet', compact('sanpham'));
    }

    // 2. Hàm xử lý AJAX khi bấm "Thêm vào giỏ hàng"
    public function addToCart(Request $request)
    {
        $id = $request->id;
        $num = (int) $request->num;

        // Lấy giỏ hàng hiện tại từ Session
        $cart = session()->get('cart', []);

        // Cộng dồn nếu đã có, tạo mới nếu chưa có
        if (isset($cart[$id])) {
            $cart[$id] += $num;
        } else {
            $cart[$id] = $num;
        }

        // Cập nhật lại Session
        session()->put('cart', $cart);

        // Tính tổng số lượng để trả về cho icon trên Menu
        $totalItems = array_sum($cart);

        return response()->json($totalItems);
    }
}