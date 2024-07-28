<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kamar;

class PenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Get all users and kamar
        $users = User::all();
        $kamars = Kamar::all();

        // Directory for dummy kartu identitas
        $directory = public_path('storage/kartu_identitas/');

        // Ensure directory exists
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Create a dummy image for kartu identitas
        $dummyImagePath = $directory . 'default_identitas.jpg';
        if (!File::exists($dummyImagePath)) {
            $dummyImageContent = file_get_contents('https://via.placeholder.com/150'); // Using a placeholder image
            File::put($dummyImagePath, $dummyImageContent);
        }

        // Store combinations to avoid duplicates
        $usedCombinations = [];

        // Create penyewa records
        foreach ($users as $user) {
            $unique = false;

            // Attempt to find a unique kamar for this user
            for ($i = 0; $i < 10; $i++) {
                $kamar = $kamars->random();
                $combination = $user->id . '-' . $kamar->id;

                if (!in_array($combination, $usedCombinations)) {
                    $usedCombinations[] = $combination;
                    $unique = true;
                    break;
                }
            }

            if ($unique) {
                DB::table('penyewa')->insert([
                    'user_id' => $user->id,
                    'nama' => $user->nama,
                    'alamat' => $faker->address,
                    'kartu_identitas' => 'default_identitas.jpg', // using the dummy image
                    'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
                    'tanggal_mulai' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
                    'tanggal_selesai' => $faker->dateTimeBetween('+1 month', '+3 months')->format('Y-m-d'),
                    'status' => $faker->randomElement(['aktif', 'tidak aktif']),
                    'kamar_id' => $kamar->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}