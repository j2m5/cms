<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->bigInteger('role_id')->unsigned()->default(1);
            $table->string('avatar')->default('uploads/avatars/avatar.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ip');
            $table->boolean('banned')->default(0);
            $table->string('server')->nullable();
            $table->string('side')->nullable();
            $table->string('char')->nullable();
            $table->string('class')->nullable();
            $table->string('spec')->nullable();
            $table->string('guild')->nullable();
            $table->string('age')->nullable();
            $table->string('vk')->nullable();
            $table->string('ok')->nullable();
            $table->string('tw')->nullable();
            $table->string('fb')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
