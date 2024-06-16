<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $table = 'penghuni';

    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'kamar_id',
        'pemilik_id'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class);
    }
}
