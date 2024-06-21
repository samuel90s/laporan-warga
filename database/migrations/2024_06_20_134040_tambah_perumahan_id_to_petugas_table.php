<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahPerumahanIdToPetugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petugas', function (Blueprint $table) {
            $table->unsignedBigInteger('perumahan_id')->nullable()->after('telp');

            // Jika Anda ingin menambahkan foreign key constraint
            $table->foreign('perumahan_id')->references('id')->on('perumahans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('petugas', function (Blueprint $table) {
            $table->dropForeign(['perumahan_id']);
            $table->dropColumn('perumahan_id');
        });
    }
}
