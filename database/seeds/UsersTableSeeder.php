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
        $user           = User::firstOrNew(["email" => "admin@admin.com"]);
        $user->name     = "الأدمن";
        $user->role_id  = 1;
        $user->email    = "admin@admin.com";
        $user->password = bcrypt("admin");
        $user->save();
    }
}
