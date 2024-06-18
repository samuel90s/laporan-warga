<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perumahan extends Model
{
    use HasFactory;

    protected $table = 'perumahans'; // Sesuaikan dengan nama tabel

    protected $fillable = [
        'nama',
        // Tambahkan kolom lain yang ingin diisi secara massal (fillable)
    ];

    // Jika perlu, definisikan relasi dengan model lain di sini
}
