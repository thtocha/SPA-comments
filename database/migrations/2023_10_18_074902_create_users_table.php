<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('email')->unique();

            $table->string('home_page')->nullable();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
