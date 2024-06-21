<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerumahanIdToPengaduan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->unsignedBigInteger('perumahan_id')->nullable();

            // Foreign key constraint
            $table->foreign('perumahan_id')->references('id')->on('perumahans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropForeign(['perumahan_id']);
            $table->dropColumn('perumahan_id');
        });
    }
}
