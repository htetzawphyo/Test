<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->integer('role_id');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('gender');
            $table->boolean('is_active');
            $table->rememberToken();
            $table->timestamps();
        }); 

        DB::table('users')->insert(
            [
                [
                    'name' => 'Administractor',
                    'username' => 'Admin',
                    'role_id' => 1,
                    'phone' => '+959 428786611',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('password'),
                    'gender' => 1,
                    'is_active' => 1
                ],
            ]
        );
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
};
