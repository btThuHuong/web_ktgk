<x-cay-canh-layout>
    <x-slot name="title">
        Trang Chủ Cây Cảnh
    </x-slot>

    <style>
        .list-caycanh {
            display: grid;
            grid-template-columns: repeat(5, 1fr); 
            gap: 15px; 
            padding: 20px 0;
        }

        .caycanh {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            padding-bottom: 10px;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
        }

        .caycanh:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-3px);
        }

        .caycanh img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .cay-canh-info {
            padding: 3px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .cay-canh-info b {
            display: block;
            color: #333;
            font-size: 0.8rem;
            margin-bottom: 5px;
            line-height: 1.2rem;
        }

        .cay-canh-info i {
            display: block;
            color: #d9534f;
            font-weight: bold;
            font-style: italic;
            font-size: 0.95rem;
        }

        /* --- CSS CHO THANH CÔNG CỤ LỌC GIỐNG ẢNH MẪU --- */
        .filter-bar {
            text-align: center;
            margin: 15px 0 5px 0;
        }
        
        .filter-btn {
            background-color: #fff;
            border: 1px solid #ddd;
            color: #333;
            padding: 6px 14px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            margin: 0 4px;
            display: inline-block;
            transition: all 0.2s;
        }

        .filter-btn:hover {
            border-color: #2f5d3a;
            color: #2f5d3a;
            text-decoration: none;
        }

        /* Trạng thái khi nút đang được chọn */
        .filter-btn.active {
            border-color: #2f5d3a;
            color: #2f5d3a;
            font-weight: bold;
            box-shadow: 0 0 5px rgba(47, 93, 58, 0.2);
        }
    </style>


    <div class="container">
        
        <div class="filter-bar">
            <span style="font-size: 14px; color: #333; margin-right: 10px;">Tìm kiếm theo</span>
            
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="filter-btn {{ request('sort') == 'asc' ? 'active' : '' }}">
                Giá tăng dần
            </a>
            
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="filter-btn {{ request('sort') == 'desc' ? 'active' : '' }}">
                Giá giảm dần
            </a>
            
            <a href="{{ request()->fullUrlWithQuery(['care' => request('care') == 'easy' ? null : 'easy']) }}" class="filter-btn {{ request('care') == 'easy' ? 'active' : '' }}">
                Dễ chăm sóc
            </a>
            
            <a href="{{ request()->fullUrlWithQuery(['light' => request('light') == 'shade' ? null : 'shade']) }}" class="filter-btn {{ request('light') == 'shade' ? 'active' : '' }}">
                Chịu được bóng râm
            </a>
        </div>
        <div id='cay-canh-div'>
            <div class='list-caycanh'>
                @foreach($products as $row)
                    <div class='caycanh shadow-sm'>
                        <a href="{{ url('chi-tiet/'.$row->id) }}" style="text-decoration: none;">
                            <img src="{{ asset('storage/image/' . $row->hinh_anh) }}" alt="{{ $row->ten_san_pham }}">
                            
                            <div class="cay-canh-info">
                                <b>{{ $row->ten_san_pham }}</b>
                                <i>{{ number_format($row->gia_ban, 0, ",", ".") }} VNĐ</i>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>
</x-cay-canh-layout>