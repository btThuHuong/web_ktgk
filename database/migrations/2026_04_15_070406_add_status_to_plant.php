<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Hàm up() dùng để thêm cột khi bạn chạy lệnh migrate
    public function up(): void
    {
        Schema::table('san_pham', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('san_pham', function (Blueprint $table) {
            // Xóa cột 'status'
            $table->dropColumn('status');
        });
    }
};