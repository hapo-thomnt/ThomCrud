<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNullabeToContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('job_title')->nullable()->change();
            $table->string('adress')->nullable()->change();
            $table->string('avatar')->nullable()->change();
            $table->boolean('isdeleted')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('job_title')->change();
            $table->string('adress')->change();
            $table->string('avatar')->change();
            $table->boolean('isdeleted')->change();
        });
    }
}
