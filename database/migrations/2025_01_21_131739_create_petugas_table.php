<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Tabel petugas
        Schema::create('petugas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petugas');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['administrator', 'kasir']);
            $table->timestamps();
            $table->softDeletes(); // Soft Delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('petugas');
    }
};
