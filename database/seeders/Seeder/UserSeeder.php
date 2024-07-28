<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Directory for dummy user photos
        $directory = public_path('storage/foto_user/');

        // Ensure directory exists
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Create a dummy image for user photos
        $dummyImagePath = $directory . 'default_user.jpg';
        if (!File::exists($dummyImagePath)) {
            $dummyImageContent = file_get_contents('https://via.placeholder.com/150'); // Using a placeholder image
            File::put($dummyImagePath, $dummyImageContent);
        }

        // Generate 10 sample users
        foreach (range(1, 10) as $index) {
            $email = $faker->unique()->safeEmail;
            
            // Check if the user already exists
            if (DB::table('user')->where('email', $email)->exists()) {
                continue;
            }

            DB::table('user')->insert([
                'nama' => $faker->name,
                'email' => $email,
                'password' => Hash::make('password'), // default password
                'hp' => substr($faker->phoneNumber, 0, 13), // limit the length of phone number to 13 characters
                'role' => 'user',
                'status' => $faker->boolean,
                'foto' => 'default_user.jpg', // using the dummy image
                'remember_token' => $faker->sha256,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}