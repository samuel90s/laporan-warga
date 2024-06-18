<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerumahansTable extends Migration
{
    public function up()
    {
        Schema::create('perumahans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email')->unique();
            $table->string('telp', 13);
            $table->string('alamat', 500);
            $table->char('rt', 4);
            $table->char('rw', 4);
            $table->char('kode_pos', 5);
            $table->char('province_id', 2);
            $table->char('regency_id', 4);
            $table->char('district_id', 7);
            $table->char('village_id', 10);
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('perumahans');
    }
}
