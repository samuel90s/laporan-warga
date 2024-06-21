<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('perumahans', function (Blueprint $table) {
            $table->string('masyarakat_id', 16)->nullable();
            $table->foreign('masyarakat_id')->references('nik')->on('masyarakat')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perumahans', function (Blueprint $table) {
            //
        });
    }
};
