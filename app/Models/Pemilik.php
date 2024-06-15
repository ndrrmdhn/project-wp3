<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik'; // sesuaikan dengan nama tabel di database jika berbeda

    protected $fillable = [
        'nama', 'telepon', 'email'
    ];

    // Relasi dengan tabel Kamar, jika diperlukan
    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }
}
