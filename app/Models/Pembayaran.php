<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pembayaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'penyewa_id',
        'kamar_id',
        'nomor_pembayaran',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
        'keterangan',
    ];

    /**
     * Get the penyewa that owns the pembayaran.
     */
    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }

    /**
     * Get the kamar that owns the pembayaran.
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}