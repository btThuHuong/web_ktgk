<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index($id = null)
    {

        $categories = DB::table('danh_muc')->get();

        $query = DB::table('san_pham');

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
    public function theloai($id)
    {
        
        $categories = DB::table('danh_muc')->get();

        $products = DB::table('san_pham')
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
