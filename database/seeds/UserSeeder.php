<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @author   Wagner Silveira <wagner.resta@outlook.com>
     * @return void
     */
    public function run()
    {
        $user = User::where('email','admin@admin.com')->first();
        if(!$user){
            $data = array(
                'id'                    => 1,
                'name'                  => 'Administrator',
                'email'                 => 'admin@admin.com',
                'password'              => 1234,
                'email_verified_at'     => date('Y-m-d H:i:s'),
            );
            $role    = Role::findByName('administrator','api');
            $newUser = User::create($data);
            $newUser->assignRole($role);
        }
    }
}
