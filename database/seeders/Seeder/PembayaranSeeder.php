<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Penyewa;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Get all penyewa
        $penyewas = Penyewa::all();

        // Store used nomor_pembayaran to avoid duplicates
        $usedNomorPembayaran = [];

        // Create pembayaran records
        foreach ($penyewas as $penyewa) {
            $unique = false;

            // Attempt to generate a unique nomor_pembayaran
            for ($i = 0; $i < 10; $i++) {
                $nomorPembayaran = $faker->unique()->numerify('PAY-#####');

                if (!in_array($nomorPembayaran, $usedNomorPembayaran)) {
                    $usedNomorPembayaran[] = $nomorPembayaran;
                    $unique = true;
                    break;
                }
            }

            if ($unique) {
                DB::table('pembayaran')->insert([
                    'penyewa_id' => $penyewa->id,
                    'kamar_id' => $penyewa->kamar_id,
                    'nomor_pembayaran' => $nomorPembayaran,
                    'tanggal_pembayaran' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                    'jumlah_pembayaran' => $faker->numberBetween(100000, 1000000),
                    'keterangan' => $faker->sentence,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}