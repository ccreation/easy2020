<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $user           = new User;
        $user->name     = "الأدمن";
        $user->email    = "admin@admin.com";
        $user->password = bcrypt("admin");
        $user->save();
    }
}
