<x-cay-canh-layout>
    <x-slot name="title">
        Chi tiết: {{ $sanpham->ten_san_pham }}
    </x-slot>

    <div class="container mt-4 mb-5" style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <div class="row">
            
            <div class="col-md-5 text-center">
                <img src="{{ asset('storage/image/' . $sanpham->hinh_anh) }}" alt="{{ $sanpham->ten_san_pham }}" class="img-fluid border" style="border-radius: 5px; max-height: 400px; object-fit: cover;">
            </div>

            <div class="col-md-7">
                <h4 style="color: #2f5d3a; font-weight: bold; margin-bottom: 20px;">{{ $sanpham->ten_san_pham }}</h4>
                
                <div style="line-height: 1.8; font-size: 15px; color: #333;">
                    <p class="mb-1">Tên khoa học: {{ $sanpham->ten_khoa_hoc }}</p>
                    <p class="mb-1">Tên thông thường: {{ $sanpham->ten_thong_thuong }}</p>
                    <p class="mb-1" style="text-align: justify;">Mô tả: {{ $sanpham->mo_ta }}</p>
                    <p class="mb-1">Quy cách sản phẩm: {{ $sanpham->quy_cach_san_pham }}</p>
                    <p class="mb-1">Độ khó: {{ $sanpham->do_kho }}</p>
                    <p class="mb-1">Yêu cầu ánh sáng: {{ $sanpham->yeu_cau_anh_sang }}</p>
                    <p class="mb-1">Nhu cầu nước: {{ $sanpham->nhu_cau_nuoc }}</p>
                </div>

                <div class="mt-3 mb-3">
                    <span style="font-size: 15px; color: #333;">Giá: </span>
                    <span style="color: red; font-style: italic; font-weight: bold; font-size: 1.3rem;">{{ number_format($sanpham->gia_ban, 0, ',', '.') }} VNĐ</span>
                </div>

                <div class="d-flex align-items-center mt-4">
                    <label for="product-number" class="mr-2 mb-0" style="font-size: 15px; color: #333;">Số lượng mua: </label>
                    <input type="number" id="product-number" class="form-control" style="width: 80px; margin-right: 15px;" value="1" min="1">
                    
                    <button class="btn text-white" style="background-color: #007bff; border-color: #007bff;" id="add-to-cart">
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#add-to-cart").click(function(){
                var id = "{{ $sanpham->id }}";
                var num = $("#product-number").val();
                
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('cart.add') }}", 
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "num": num
                    },
                    success: function(data){
                        $("#cart-number-product").html(data);
                        alert("Đã thêm thành công vào giỏ hàng!");
                    },
                    error: function (xhr, status, error){
                        alert("Có lỗi xảy ra, vui lòng tải lại trang!");
                        console.log(xhr.responseText); 
                    }
                });
            });
        });
    </script>
</x-cay-canh-layout>