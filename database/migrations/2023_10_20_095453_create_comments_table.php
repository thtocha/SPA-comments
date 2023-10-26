<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('parent_id')->unsigned()->nullable();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('parent_id')->references('id')->on('comments');

            $table->text('text');

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
