<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsPerumahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perumahans', function (Blueprint $table) {
            $table->renameColumn('masyarakat_id', 'nik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perumahans', function (Blueprint $table) {
            $table->renameColumn('nik', 'masyarakat_id');
        });
    }
}

