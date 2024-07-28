<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Directory for dummy room photos
        $directory = public_path('storage/img-kamar/');

        // Ensure directory exists
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Create a dummy image for room photos
        $dummyImagePath = $directory . 'default_kamar.jpg';
        if (!File::exists($dummyImagePath)) {
            $dummyImageContent = file_get_contents('https://via.placeholder.com/640x480'); // Using a placeholder image
            File::put($dummyImagePath, $dummyImageContent);
        }

        // Generate 10 sample rooms
        foreach (range(1, 10) as $index) {
            DB::table('kamar')->insert([
                'nomor' => $faker->unique()->numberBetween(100, 999),
                'deskripsi' => $faker->sentence,
                'harga' => $faker->randomFloat(2, 1000000, 5000000),
                'luas' => $faker->randomFloat(1, 15, 30),
                'tipe_kamar' => $faker->randomElement(['putra', 'putri', 'campuran']),
                'status' => $faker->randomElement(['tersedia', 'disewa', 'terbooking']),
                'alamat' => $faker->address,
                'fasilitas_ac' => $faker->boolean,
                'fasilitas_wifi' => $faker->boolean,
                'fasilitas_tv' => $faker->boolean,
                'fasilitas_perabotan' => $faker->boolean,
                'fasilitas_dapur' => $faker->boolean,
                'fasilitas_kamar_mandi_dalam' => $faker->boolean,
                'fasilitas_keamanan_24_jam' => $faker->boolean,
                'fasilitas_tempat_parkir' => $faker->boolean,
                'foto' => 'default_kamar.jpg', // using the dummy image
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}