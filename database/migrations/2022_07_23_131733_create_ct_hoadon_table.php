<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_hoadon', function (Blueprint $table) {
            $table->id();
            $table->string('id_sanpham');
            $table->string('ten_kh');
            $table->string('email')->unique();
            $table->string('dia_chi');
            $table->integer('gia');
            $table->string('hinh_anh');
            $table->integer('tong_tien');
            $table->string('mo_ta')->nullable();
            $table->integer('trang_thai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ct_hoadon');
    }
};
