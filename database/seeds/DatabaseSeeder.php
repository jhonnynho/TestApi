<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Priority;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PrioritySeeder::class);
    }
}

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->firstname = "John";
        $user->lastname = "Doe";
        $user->email = "test@admin.com";
        $user->password = Hash::make('123456');
        $user->role_id = Role::where('role','=','Administrator')->select('id')->value('id');
        $user->save();
    }
}

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data=array('Administrator','Employee');

        for($i=0;$i<count($data);$i++){
            $role = new Role;
            $role->role = $data[$i];
            $role->save();
        }
    }
}

class PrioritySeeder extends Seeder
{
    public function run()
    {
        $data=array('High','Medium','Low');

        for($i=0;$i<count($data);$i++){
            $priority = new Priority;
            $priority->name = $data[$i];
            $priority->save();
        }
    }
}
