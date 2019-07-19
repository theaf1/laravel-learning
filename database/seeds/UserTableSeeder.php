<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //    \App\User::create([
    //     'name' => Str::random(10),
    //     'email' => Str::random(10).'@gmail.com',
    //     'username' => Str::random(10)
    //     'password' => bcrypt('secret'),
    // };
    factory(\App\user::class,1000)->create()->each(function($user)
    {
        \App\Roleuser::create(['user_id'=> $user->id,'role_id'=>3]);
    });
    }
}
