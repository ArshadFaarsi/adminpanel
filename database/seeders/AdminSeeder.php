<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'0123456789',
            'password'=>bcrypt(12345678),
            'image'=>'public/admin/assets/images/users/admin.png',
        ]);
    }
}
