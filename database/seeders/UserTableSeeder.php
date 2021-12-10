<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nomor_karyawan'=> 'NIP00000001',
            'status'=> 'aktif',
            'name'=> 'Reza D',
            'email'=> 'daulayreza@gmail.com',
            'phone_number'=> '+6282362216649',
            'password' => Hash::make('123456'),
            'role'=> 'admin'
        ]);
    }
}
