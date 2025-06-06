<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id
            $table->string('username'); // имя
            $table->string('email')->unique(); // email уникальный
            $table->string('password'); // пароль (хэш)
            $table->enum('role', ['admin', 'user'])->default('user'); // роль: админ или пользователь
            $table->timestamps(); // created_at и updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
