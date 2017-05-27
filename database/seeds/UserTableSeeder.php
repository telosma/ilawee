<?php

use Illuminate\Database\Seeder;
use App\Models\{User, Role};

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = config('default.avatar');
        $size = 40;
        // Create admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@ilawee.com',
            'password' => 'admin',
            'avatar_link' => "https://www.gravatar.com/avatar/" . md5('admin@ilawee.com') . "?d=" . urlencode( $default ) . "&s=" . $size,
            'confimed' => 1
        ]);
        $admin->attachRole(Role::where('name', 'admin')->first());
        // Create CTV
        $manager = User::create([
            'name' => 'CTV_01',
            'email' => 'ctv_01@ilawee.com',
            'password' => 'manager',
            'avatar_link' => "https://www.gravatar.com/avatar/" . md5('manager@ilawee.com') . "?d=" . urlencode( $default ) . "&s=" . $size,
            'confimed' => 1
        ]);
        $manager->attachRole(Role::where('name', 'manager')->first());
    }
}
