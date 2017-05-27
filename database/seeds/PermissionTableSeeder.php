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
        // role
            [
                'name' => 'role-read',
                'display_name' => 'show role',
                'description' => 'Xem danh sach cac role',
            ],
            [
                'name' => 'role-create',
                'display_name' => 'create role',
                'description' => 'Tao moi role',
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'edit role',
                'description' => 'Chinh sua role',
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'delete role',
                'description' => 'Xoa role',
            ],
        // document
            [
                'name' => 'document-read',
                'display_name' => 'show document',
                'description' => 'Xem van ban',
            ],
            [
                'name' => 'document-create',
                'display_name' => 'create document',
                'description' => 'Tao moi van ban',
            ],
            [
                'name' => 'document-download',
                'display_name' => 'download document',
                'description' => 'Tai ve van ban',
            ],
        // post
            [
                'name' => 'post-create',
                'display_name' => 'create post',
                'description' => 'Gui cau hoi',
            ],
            [
                'name' => 'post-show',
                'display_name' => 'show document',
                'description' => 'Xem cau hoi',
            ],
        // organization
            [
                'name' => 'organization-index',
                'display_name' => 'index organization',
                'description' => 'Quan ly danh sach co quan ban hanh',
            ],
            [
                'name' => 'organization-create',
                'display_name' => 'create organization',
                'description' => 'Tao moi co quan',
            ],
            [
                'name' => 'organization-edit',
                'display_name' => 'edit organization',
                'description' => 'Sua thong tin co quan',
            ],
            [
                'name' => 'organization-delete',
                'display_name' => 'delete organization',
                'description' => 'Xoa co quan',
            ],
        // signer
            [
                'name' => 'signer-index',
                'display_name' => 'index signer',
                'description' => 'Quan ly nguoi ky',
            ],
            [
                'name' => 'signer-create',
                'display_name' => 'create signer',
                'description' => 'Tao moi nguoi ky',
            ],
            [
                'name' => 'signer-edit',
                'display_name' => 'edit signer',
                'description' => 'Sua thong tin nguoi ky',
            ],
            [
                'name' => 'document-delete',
                'display_name' => 'delete signer',
                'description' => 'Xoa thong tin nguoi ky',
            ],
        // comment
            [
                'name' => 'comment-create',
                'display_name' => 'create comment',
                'description' => 'Tra loi cau hoi',
            ]

        ];

        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
