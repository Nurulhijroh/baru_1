<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJurusanNullableInMahasiswasTable extends Migration
{
    public function up()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->string('jurusan')->nullable()->change();  // Membuat 'jurusan' nullable
        });
    }

    public function down()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->string('jurusan')->nullable(false)->change();  // Mengubah kembali menjadi NOT NULL
        });
    }
}