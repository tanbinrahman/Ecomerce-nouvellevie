<?php

namespace Database\Seeders;

use App\Models\admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::where('email', 'admin@gmail.com')->first();
        if (is_null($user)) {
            $user = new Admin();
            $user->username = "Admin";
            $user->email = "admin@gmail.com";
            $user->password = Hash::make('123456789');
            $user->save();
        }
    }
}
