<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models as Database;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Database\User::create([
            'name' => 'Admin',
            'email' => 'manhlinh@finalstyle.com',
            'phone' => '0383760076',
            'password' => bcrypt(123456),
            'status' => Database\User::STATUS_ACTIVE,
            'type' => Database\User::ROLE_ADMIN,
        ]);
    }
}
