<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
        if (!User::where('email', 'admin@admin.pl')->first()) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@admin.pl',
                'password' => Hash::make('zaq1@WSX'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'is_admin' => 1
            ]);
        }
    }
}
