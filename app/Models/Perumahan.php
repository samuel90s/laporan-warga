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
    ];
}
