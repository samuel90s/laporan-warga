<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perumahan extends Model
{
    use HasFactory;

    protected $table = 'perumahans'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'nama_perumahan',
        'alamat',
        'contact',
        'nik' // Asumsi ada kolom 'nik' untuk relasi dengan Masyarakat
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }

    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'perumahan_id', 'id');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'perumahan_id', 'id');
    }
}
