<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DummySeeder extends Seeder
{
    public function run(): void
    {

        for ($i=4990; $i < 10001; $i++) {
            User::create([
                'name' => 'User Ke '.$i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => Hash::make('inipassword'),
        ]);
    }
}
}
