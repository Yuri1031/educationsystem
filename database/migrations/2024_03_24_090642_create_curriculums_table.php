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
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('thumbnail', 255)->nullable();
            $table->longText('description');
            $table->mediumText('video_url');
            $table->tinyInteger('alway_delivery_flg')->default(0);
            $table->unsignedBigInteger('grade_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('grade_id')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
};

