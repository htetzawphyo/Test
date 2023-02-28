<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('feature_id');
            $table->timestamps();
        });

        DB::table('permissions')->insert(
            [
                [
                    'name' => 'Create User',
                    'feature_id' => '1'
                ],
                [
                    'name' => 'View User',
                    'feature_id' => '1'
                ],
                [
                    'name' => 'Update User',
                    'feature_id' => '1'
                ],
                [
                    'name' => 'Delete User',
                    'feature_id' => '1'
                ],
                [
                    'name' => 'Create Role',
                    'feature_id' => '2'
                ],
                [
                    'name' => 'View Role',
                    'feature_id' => '2'
                ],
                [
                    'name' => 'Update Role',
                    'feature_id' => '2'
                ],
                [
                    'name' => 'Delete Role',
                    'feature_id' => '2'
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
        Schema::dropIfExists('permissions');
    }
};
