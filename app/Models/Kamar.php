<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kamar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor',
        'deskripsi',
        'harga',
        'luas',
        'tipe_kamar',
        'status',
        'alamat',
        'fasilitas_ac',
        'fasilitas_wifi',
        'fasilitas_tv',
        'fasilitas_perabotan',
        'fasilitas_dapur',
        'fasilitas_kamar_mandi_dalam',
        'fasilitas_keamanan_24_jam',
        'fasilitas_tempat_parkir',
        'foto',
    ];

    /**
     * Get the penyewas for the kamar.
     */
    public function penyewa()
    {
        return $this->hasMany(Penyewa::class);
    }

    /**
     * Get the pembayarans for the kamar.
     */
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}