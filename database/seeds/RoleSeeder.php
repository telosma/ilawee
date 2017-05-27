<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

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
            [
                'name' => 'user',
                'display_name' => 'user',
                'description' => 'Người dùng',
            ],
            [
                'name' => 'manager',
                'display_name' => 'manager',
                'description' => 'Cộng tác viên',
            ],
            [
                'name' => 'admin',
                'display_name' => 'admin',
                'description' => 'Quản trị hệ thống',
            ]
        ];
    }
}
