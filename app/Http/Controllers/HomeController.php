<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Thêm Request $request để bắt các nút bấm lọc trên URL
    public function index(Request $request, $id = null)
    {
        $categories = DB::table('danh_muc')->get();

        $query = DB::table('san_pham');

        // ========================================================
        // PHẦN THÊM MỚI: CHỨC NĂNG LỌC
        // (Chèn ngầm vào biến $query trước khi code gốc thực thi)
        // ========================================================
        if ($request->has('care') && $request->care == 'easy') {
            $query->where('san_pham.do_kho', 'like', '%Dễ%');
        }

        if ($request->has('light') && $request->light == 'shade') {
            $query->where('san_pham.yeu_cau_anh_sang', 'like', '%râm%');
        }

        if ($request->has('sort')) {
            if ($request->sort == 'asc') {
                $query->orderBy('san_pham.gia_ban', 'asc');
            } elseif ($request->sort == 'desc') {
                $query->orderBy('san_pham.gia_ban', 'desc');
            }
        }
        // ========================================================
        // KẾT THÚC PHẦN LỌC
        // ========================================================

        // GIỮ NGUYÊN 100% CODE GỐC (Kể cả các dòng comment)
        if ($id) {
    
            $products = $query->join('sanpham_danhmuc', 'san_pham.id', '=', 'sanpham_danhmuc.id_san_pham')
                            ->where('sanpham_danhmuc.id_danh_muc', $id)
                            //->where('san_pham.status', 1)
                            ->select('san_pham.*')
                            ->get();
        } else {
            
            $products = $query//->where('status', 1)
                            ->limit(20)
                            ->get();
        }

        return view('caycanh.index', compact('categories', 'products'));
    }


    // Thêm Request $request vào đây tương tự
    public function theloai(Request $request, $id)
    {
        $categories = DB::table('danh_muc')->get();

        // Tách biến $query ra để chèn bộ lọc vào giữa
        $query = DB::table('san_pham');

        // ========================================================
        // PHẦN THÊM MỚI: CHỨC NĂNG LỌC
        // ========================================================
        if ($request->has('care') && $request->care == 'easy') {
            $query->where('san_pham.do_kho', 'like', '%Dễ%');
        }

        if ($request->has('light') && $request->light == 'shade') {
            $query->where('san_pham.yeu_cau_anh_sang', 'like', '%râm%');
        }

        if ($request->has('sort')) {
            if ($request->sort == 'asc') {
                $query->orderBy('san_pham.gia_ban', 'asc');
            } elseif ($request->sort == 'desc') {
                $query->orderBy('san_pham.gia_ban', 'desc');
            }
        }
        // ========================================================

        // GIỮ NGUYÊN 100% CODE GỐC
        $products = $query
            ->join('sanpham_danhmuc', 'san_pham.id', '=', 'sanpham_danhmuc.id_san_pham')
            ->where('sanpham_danhmuc.id_danh_muc', $id)
            ->select('san_pham.*')
            ->get();

        return view('caycanh.index', compact('categories', 'products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $categories = DB::table('danh_muc')->get();

        $products = DB::table('san_pham')
            ->where('ten_san_pham', 'LIKE', '%' . $keyword . '%')
            //->where('status', 1)
            ->get();

        
        return view('caycanh.index', compact('categories', 'products', 'keyword'));
    }
}

