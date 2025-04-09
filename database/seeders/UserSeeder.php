<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks sementara agar bisa truncate
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // Data user yang ingin dimasukkan
        $data = [
            [
                'nama' => "Adminsatu",
                'email' => "adminsatu@gmail.com",
                'username' => "Admin1",
                'slug' => 'admin1'
            ],
            [
                'nama' => "Admindua",
                'email' => "admindua@gmail.com",
                'username' => "Admin2",
                'slug' => 'admin2'
            ],
            [
                'nama' => "Admintiga",
                'email' => "admintiga@gmail.com",
                'username' => "Admin3",
                'slug' => 'admin3'
            ]
        ];

        // Loop dan insert data dengan password di-hash
        foreach ($data as $hasil) {
            User::insert([
                'role_id' => 1,
                'nama' => $hasil['nama'],
                'email' => $hasil['email'],
                'username' => $hasil['username'],
                'slug' => $hasil['slug'],
                'password' => Hash::make('admin12345'), // password di-hash
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
