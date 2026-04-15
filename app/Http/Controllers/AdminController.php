<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function plant_list()
    {
        $ds_cay = DB::table('san_pham')->where('status', 1)->get();
        return view('caycanh.plant_list', compact('ds_cay'));
    }

    public function plant_delete($id)
    {
        DB::table('san_pham')->where('id', $id)->update(['status' => 0]);
        return redirect()->back()->with('success', 'Đã xóa sản phẩm thành công!');
    }

    public function plant_create()
    {
        return view('caycanh.create');
    }

    public function plant_save(Request $request)
    {
        $randomCode = 'SP_' . time();
        // dd($request->file('hinh_anh'), $request->all());
        $request->validate([
            'ten_san_pham'     => 'required',
            'ten_khoa_hoc'     => 'required',
            'ten_thong_thuong' => 'required',
            'mo_ta'            => 'required',
            'do_kho'           => 'required',
            'yeu_cau_anh_sang' => 'required',
            'nhu_cau_nuoc'     => 'required',
            'gia_ban'          => 'required|numeric',
            'hinh_anh'         => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'ten_san_pham.required'     => 'Vui lòng nhập tên sản phẩm.',
            'ten_khoa_hoc.required'     => 'Vui lòng nhập tên khoa học.',
            'ten_thong_thuong.required' => 'Vui lòng nhập tên thông thường.',
            'mo_ta.required'            => 'Vui lòng nhập mô tả.',
            'do_kho.required'           => 'Vui lòng nhập độ khó.',
            'yeu_cau_anh_sang.required' => 'Vui lòng nhập yêu cầu ánh sáng.',
            'nhu_cau_nuoc.required'     => 'Vui lòng nhập nhu cầu nước.',
            'gia_ban.required'          => 'Vui lòng nhập giá bán.',
            'gia_ban.numeric'           => 'Giá bán phải là một số hợp lệ.',
            'hinh_anh.required'         => 'Vui lòng tải lên ảnh sản phẩm.',
            'hinh_anh.image'            => 'File tải lên không phải là định dạng ảnh.',
            'hinh_anh.mimes'            => 'Ảnh chỉ chấp nhận đuôi jpeg, png, jpg, gif, webp.',
        ]);

        // 2. Xử lý lưu file ảnh vào thư mục storage/app/public/image 
        $fileName = ''; 
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/image', $fileName); 
        }

        // 3. Lưu dữ liệu vào Database bằng DB::table
        DB::table('san_pham')->insert([
            'code'             => $randomCode,
            'ten_san_pham'     => $request->ten_san_pham,
            'ten_khoa_hoc'     => $request->ten_khoa_hoc,
            'ten_thong_thuong' => $request->ten_thong_thuong,
            'mo_ta'            => $request->mo_ta,
            'do_kho'           => $request->do_kho,
            'yeu_cau_anh_sang' => $request->yeu_cau_anh_sang,
            'nhu_cau_nuoc'     => $request->nhu_cau_nuoc,
            'gia_ban'          => $request->gia_ban,
            'hinh_anh'         => $fileName,
            'status'           => 1  
        ]);

        return back()->with('success', 'Đã thêm sản phẩm cây cảnh thành công!');
    }
}