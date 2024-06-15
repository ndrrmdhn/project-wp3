<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksidetail'; // Pastikan ini sesuai dengan nama tabel di database

    protected $fillable = [
        'notran',
        'produk_id',
        'harga',
        'jumbel'
    ];
}
