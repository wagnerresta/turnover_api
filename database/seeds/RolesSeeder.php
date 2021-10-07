<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Creates permission rules for users, checking if the rule already exists, so as not to duplicate
     * @author   Wagner Silveira <wagner.resta@outlook.com>
     * @return void
     */
    public function run()
    {
        $rolesAvailable = array('administrator','client');
        foreach($rolesAvailable as $key => $role){
            Role::findOrCreate($role,'api');
        }
    }
}
