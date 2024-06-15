<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public $timestamps = true;
    protected $table = "transaksi";
    // protected $fillable = ['nama','hp'];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
