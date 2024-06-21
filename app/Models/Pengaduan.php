<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $dates = ['tgl_pengaduan', 'tgl_kejadian'];
    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'judul_laporan',
        'isi_laporan',
        'tgl_kejadian',
        'lokasi_kejadian',
        'foto',
        'status',
        'category_pengaduan',
        'perumahan_id',
    ];

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function user()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }

    public function perumahan(): BelongsTo
    {
        return $this->belongsTo(Perumahan::class, 'perumahan_id', 'id');
    }
}

