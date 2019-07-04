<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('role_id');
            $table->timestamps();
        });

        $role_users = array(
            ['user_id' => 1, 'role_id' => 1 ],
            ['user_id' => 1, 'role_id' => 2 ],
            ['user_id' => 2, 'role_id' => 1 ],
            ['user_id' => 2, 'role_id' => 2 ],
            ['user_id' => 3, 'role_id' => 2 ],
            ['user_id' => 4, 'role_id' => 3 ],
        );
        foreach ($role_users as $role_user){
            \App\RoleUser::create($role_user);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_users');
    }
}
