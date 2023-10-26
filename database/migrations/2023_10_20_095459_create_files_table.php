<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('comment_id')->unsigned();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type');

            $table->foreign('comment_id')->references('id')->on('comments');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
