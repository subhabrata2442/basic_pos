<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            array('name' => 'Admin', 'tag' => 'admin', 'icon' => 'fas fa-user-shield'),
            array('name' => 'Estimating Access', 'tag' => 'estimating_access', 'icon' => 'fas fa-calculator'),
            array('name' => 'Operations Team', 'tag' => 'operations_team', 'icon' => 'fas fa-users'),
            array('name' => 'Designs', 'tag' => 'designs', 'icon' => 'fas fa-drafting-compass'),
            array('name' => 'Accounts', 'tag' => 'accounts', 'icon' => 'fas fa-coins'),
            array('name' => 'Engineers', 'tag' => 'engineers', 'icon' => 'fas fa-users-cog'),
            array('name' => 'Normal User', 'tag' => 'normal_user', 'icon' => 'fas fa-user'),
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
