<?php

use App\Models\General\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('phone', 15)->nullable();
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 191)->nullable();
            $table->text('password');
            $table->string('avatar', 191)->nullable();
            $table->string('reset_code', 191)->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        User::create([
            'name'=>'admin',
            'email'=>'admin@test.com',
            'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),
            'role'=>'admin',
            'mobile'=>'7795588800',
        ]);
    }

    public function down()
    {
        Schema::drop('users');
    }
}
