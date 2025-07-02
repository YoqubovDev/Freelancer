<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('birthday')->nullable();
            $table->string('degree')->nullable();
            $table->string('experience')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('freelance')->nullable();
            $table->text('description');
            $table->string('about_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
