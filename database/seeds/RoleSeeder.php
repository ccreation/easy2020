<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role       = Role::firstOrNew(["id" => 1]);
        $role->name = "الأدمن";
        $role->save();
    }
}
