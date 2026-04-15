<x-cay-canh-layout>
    <x-slot name="title">
        Quản lý sản phẩm
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $('#id-table').DataTable({
                responsive: true,
                pageLength: 10, 
                lengthMenu: [10, 25, 50, 100],
                bStateSave: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json'
                }
            });
        });
    </script>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style='text-align:center; color:#15c; font-weight:bold; font-size:20px; text-transform: uppercase; margin-bottom: 15px;'>
        Quản lý sản phẩm
    </div>
    
    <a href="/caycanh/create" class='btn btn-sm btn-success mb-2'>Thêm</a>
    
    <table id="id-table" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Tên khoa học</th>
                <th>Tên thông thường</th>
                <th>Độ khó</th>
                <th>Yêu cầu ánh sáng</th>
                <th>Nhu cầu nước</th>
                <th>Giá bán</th>
                <th>Ảnh</th>
                <th width="120px">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ds_cay as $cay)
            <tr>
                <td>{{ $cay->ten_san_pham }}</td>
                <td>{{ $cay->ten_khoa_hoc }}</td>
                <td>{{ $cay->ten_thong_thuong }}</td>
                <td>{{ $cay->do_kho }}</td>
                <td>{{ $cay->yeu_cau_anh_sang }}</td>
                <td>{{ $cay->nhu_cau_nuoc }}</td>
                <td>{{ number_format($cay->gia_ban, 0, ',', '.') }} VNĐ</td>
                
                <td style="text-align: center;">
                    <img src="{{ asset('storage/image/' . $cay->hinh_anh) }}" width="60px" alt="Ảnh cây">
                </td>
                
                <td>
                    <div class="btn-group">
                        <a href="{{ route('caycanh.chitiet', ['id' => $cay->id]) }}" class='btn btn-sm btn-primary'>Xem</a>
                        &nbsp;
                        
                        <form method='POST' action="{{ route('admin.plant.delete', ['id' => $cay->id]) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');" style="display: inline-block;">
                            @csrf
                            <input type='submit' class='btn btn-sm btn-danger' value='Xóa'>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-cay-canh-layout>