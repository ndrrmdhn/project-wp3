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
     * @var array<int, string>
     */
    protected $fillable = [
        'pemilik',
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
        'foto_utama',
        'foto_tambahan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fasilitas_ac' => 'boolean',
        'fasilitas_wifi' => 'boolean',
        'fasilitas_tv' => 'boolean',
        'fasilitas_perabotan' => 'boolean',
        'fasilitas_dapur' => 'boolean',
        'fasilitas_kamar_mandi_dalam' => 'boolean',
        'fasilitas_keamanan_24_jam' => 'boolean',
        'fasilitas_tempat_parkir' => 'boolean',
        'foto_tambahan' => 'array',
        'harga' => 'decimal:2',
        'luas' => 'float',
    ];
}
