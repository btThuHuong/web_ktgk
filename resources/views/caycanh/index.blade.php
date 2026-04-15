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

    </style>

    <div class="container">
        
        <div id='cay-canh-div'>
            <div class='list-caycanh'>
                @foreach($products as $row)
                    <div class='caycanh shadow-sm'>
                        <a href="{{ url('caycanh/chitiet/'.$row->id) }}" style="text-decoration: none;">
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