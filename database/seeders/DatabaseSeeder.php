<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kamar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('P@55word'),
            'hp' => '081234567890',
            'role' => 'admin',
            'status' => true,
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            'nama' => 'Fulan Bin Fulan',
            'email' => 'user@gmail.com',
            'password' => bcrypt('P@55word'),
            'hp' => '087654321098',
            'role' => 'user',
            'status' => true,
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kamar::create([
            'nomor' => '301',
            'deskripsi' => 'Kamar ini terletak di lantai 3',
            'harga' => 1500000.00,
            'luas' => 20.5,
            'tipe_kamar' => 'campuran',
            'status' => 'tersedia',
            'alamat' => 'Jl. Sipelem No.22, Kraton, Kec. Tegal Bar., Kota Tegal, Jawa Tengah 52112',
            'fasilitas_ac' => true,
            'fasilitas_wifi' => true,
            'fasilitas_tv' => false,
            'fasilitas_perabotan' => true,
            'fasilitas_dapur' => false,
            'fasilitas_kamar_mandi_dalam' => true,
            'fasilitas_keamanan_24_jam' => true,
            'fasilitas_tempat_parkir' => true,
            'foto' => 'kamar_301',
        ]);
        Kamar::create([
            'nomor' => '302',
            'deskripsi' => 'Kamar ini terletak di lantai 3',
            'harga' => 1200000.00,
            'luas' => 18.5,
            'tipe_kamar' => 'campuran',
            'status' => 'tersedia',
            'alamat' => 'Jl. Sipelem No.22, Kraton, Kec. Tegal Bar., Kota Tegal, Jawa Tengah 52112',
            'fasilitas_ac' => true,
            'fasilitas_wifi' => true,
            'fasilitas_tv' => false,
            'fasilitas_perabotan' => true,
            'fasilitas_dapur' => false,
            'fasilitas_kamar_mandi_dalam' => true,
            'fasilitas_keamanan_24_jam' => true,
            'fasilitas_tempat_parkir' => true,
            'foto' => 'kamar_302',
        ]);
        Kamar::create([
            'nomor' => '303',
            'deskripsi' => 'Kamar ini terletak di lantai 3',
            'harga' => 1500000,
            'luas' => 20.5,
            'tipe_kamar' => 'campuran',
            'status' => 'tersedia',
            'alamat' => 'Jl. Sipelem No.22, Kraton, Kec. Tegal Bar., Kota Tegal, Jawa Tengah 52112',
            'fasilitas_ac' => true,
            'fasilitas_wifi' => true,
            'fasilitas_tv' => false,
            'fasilitas_perabotan' => true,
            'fasilitas_dapur' => false,
            'fasilitas_kamar_mandi_dalam' => true,
            'fasilitas_keamanan_24_jam' => true,
            'fasilitas_tempat_parkir' => true,
            'foto' => 'kamar_303',
        ]);

        // $this->call([
        //     UserSeeder::class
        // ]);        
        // $this->call([
        //     SeedersKamarSeeder::class
        // ]);
        // $this->call([
        //     PenyewaSeeder::class
        // ]);
        // $this->call([
        //     PembayaranSeeder::class
        // ]);
    }
}
