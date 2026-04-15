<x-cay-canh-layout>
    <x-slot name="title">Thêm Sản Phẩm</x-slot>

    <div style="padding: 10px 30px; max-width: 800px; margin: 0 auto;">
        <h5 style="text-align: center; color: #0056b3; font-weight: bold; margin-bottom: 20px; text-transform: uppercase;">
            THÊM
        </h5>

        @if(session('success'))
            <div class="alert alert-success" style="color: green; font-weight: bold; text-align: center; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.plant.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Tên sản phẩm</label>
                <input type="text" name="ten_san_pham" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;" value="{{ old('ten_san_pham') }}">
                @error('ten_san_pham') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Tên khoa học</label>
                <input type="text" name="ten_khoa_hoc" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;" value="{{ old('ten_khoa_hoc') }}">
                @error('ten_khoa_hoc') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Tên thông thường</label>
                <input type="text" name="ten_thong_thuong" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;" value="{{ old('ten_thong_thuong') }}">
                @error('ten_thong_thuong') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Mô tả</label>
                <textarea name="mo_ta" class="form-control" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;">{{ old('mo_ta') }}</textarea>
                @error('mo_ta') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Độ khó</label>
                <input type="text" name="do_kho" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;" value="{{ old('do_kho') }}">
                @error('do_kho') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Yêu cầu ánh sáng</label>
                <input type="text" name="yeu_cau_anh_sang" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;" value="{{ old('yeu_cau_anh_sang') }}">
                @error('yeu_cau_anh_sang') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Nhu cầu nước</label>
                <input type="text" name="nhu_cau_nuoc" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;" value="{{ old('nhu_cau_nuoc') }}">
                @error('nhu_cau_nuoc') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Giá bán</label>
                <input type="number" step="0.01" name="gia_ban" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px;" value="{{ old('gia_ban') }}">
                @error('gia_ban') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-weight: 500;">Ảnh</label><br>
                <input type="file" name="hinh_anh" style="width: 100%; padding: 5px; border: 1px solid #ced4da; border-radius: 4px; background-color: #fff;">
                @error('hinh_anh') <span style="color: red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div style="text-align: center; margin-top: 25px; margin-bottom: 30px;">
                <button type="submit" class="btn btn-primary" style="background-color: #007bff; color: white; border: none; border-radius: 4px; padding: 8px 30px; cursor: pointer; font-weight: bold;">Lưu</button>
            </div>
        </form>
    </div>
</x-cay-canh-layout>