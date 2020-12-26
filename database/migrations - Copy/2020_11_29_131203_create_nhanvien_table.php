<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhanvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedSmallInteger('nv_ma')->autoIncrement()->comment('Mã nhân viên, 1-chưa phân công');
            $table->string('nv_taiKhoan',50)->comment('Tài khoản # Tài khoản');
            $table->string('nv_matKhau',256)->comment('Mật khẩu # Mật khẩu');
            $table->string('nv_hoTen')->comment('Họ tên # Họ tên');
            $table->unsignedTinyInteger('nv_gioiTinh')->default('1')->comment('Họ tên # Họ tên');
            $table->string('nv_email',100)->comment('Email # Email');
            $table->dateTime('nv_ngaySinh')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Ngày sinh # Ngày sinh');
            $table->string('nv_dienThoai',11)->comment('Điện thoại # Điện thoại');
            $table->timestamp('nv_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo nhân viên');
            $table->timestamp('nv_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật nhân viên gần nhất');
            $table->unsignedTinyInteger('nv_trangThai')->default('2')->comment('Trạng thái # Trạng thái nhân viên: 1-khóa, 2-khả dụng');
            $table->unsignedTinyInteger('q_ma')->comment('Mã quyền: 1-Giám đốc, 2-Quản trị, 3-Quản lý kho, 4-Kế toán, 5-Nhân viên bán hàng, 6-Nhân viên giao hàng');
            $table->foreign('q_ma')
                ->references('q_ma')->on('quyen')
                ->onDelete('RESTRICT')
                ->onUpdate('RESTRICT');
            $table->string('nv_ghinhodangnhap',191);
        });
        
        DB::statement("ALTER TABLE `nhanvien` comment 'Nhân viên # Nhân viên'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhanvien');
    }
}
