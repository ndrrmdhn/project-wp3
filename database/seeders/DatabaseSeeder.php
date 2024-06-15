<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081234567891',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Sopian Aji',
            'email' => 'sopianaji@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Andre Ramadhan',
            'email' => 'andre@gmail.com',
            'role' => '2',
            'status' => 0,
            'hp' => '083124332900',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Mahesa Agni',
            'email' => 'mahes@gmail.com',
            'role' => '2',
            'status' => 0,
            'hp' => '085700041709',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Farrel Rizkian',
            'email' => 'Farrel@gmail.com',
            'role' => '2',
            'status' => 0,
            'hp' => '082328587316',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Adhanta Cahya Purnama',
            'email' => 'adhanta@gmail.com',
            'role' => '2',
            'status' => 0,
            'hp' => '082313872679',
            'password' => bcrypt('P@55word'),
        ]);
        Kategori::create([
            'nama_kategori' => 'Brownies',
        ]);
        Kategori::create([
            'nama_kategori' => 'Cookies',
        ]);
        Kategori::create([
            'nama_kategori' => 'Doughnuts',
        ]);
        Kategori::create([
            'nama_kategori' => 'Croissants',
        ]);
        Kategori::create([
            'nama_kategori' => 'Muffins',
        ]);
    }
}
