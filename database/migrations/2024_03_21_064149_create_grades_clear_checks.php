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
        Schema::create('grades_clear_checks', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('grade_id');
            $table->tinyInteger('clear_flg')->default(0);
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
        Schema::dropIfExists('grades_clear_checks');

    }
};
