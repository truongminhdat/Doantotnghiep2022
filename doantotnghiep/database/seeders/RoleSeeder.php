<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'description' => 'Administrator'
            ],
            [
                'id' => 2,
                'name' => 'User',
                'description' => 'User'
            ],
        ]);
    }
}
