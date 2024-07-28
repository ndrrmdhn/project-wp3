<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penyewa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'kartu_identitas',
        'gender',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'kamar_id',
    ];

    /**
     * Get the user that owns the penyewa.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kamar that the penyewa is renting.
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    /**
     * Get the pembayarans for the penyewa.
     */
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}