<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'role-read',
                'display_name' => 'Index role',
                'description' => 'Xem danh sach cac role',
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create role',
                'description' => 'Tao moi role',
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit role',
                'description' => 'Chinh sua role',
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete role',
                'description' => 'Xoa role',
            ]
        ];

        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
