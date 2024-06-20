<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('masyarakat', function (Blueprint $table) {
            $table->unsignedBigInteger('perumahan_id')->nullable();
            $table->foreign('perumahan_id')->references('id')->on('perumahans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('masyarakat', function (Blueprint $table) {
            $table->dropForeign(['perumahan_id']);
            $table->dropColumn('perumahan_id');
        });
    }
};
