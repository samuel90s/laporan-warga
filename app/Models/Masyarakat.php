<?php
// app/Models/Masyarakat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'masyarakat'; // Nama tabel di database

    protected $primaryKey = 'nik'; // Primary key dari tabel

    public $incrementing = false; // Mengindikasikan apakah primary key auto increment atau tidak

    protected $fillable = [
        'nik',
        'name',
        'email',
        'email_verified_at',
        'username',
        'jenis_kelamin',
        'password',
        'telp',
        'alamat',
        'rt',
        'rw',
        'kode_pos',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'perumahan_id', // Menambahkan kolom perumahan_id untuk relasi
    ];

    /**
     * Relationship with Perumahan model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function perumahan()
    {
        return $this->belongsTo(Perumahan::class, 'perumahan_id', 'id');
    }

    /**
     * Relationship with Pengaduan model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'nik', 'nik');
    }
}

