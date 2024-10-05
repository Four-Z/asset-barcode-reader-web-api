<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengadaanBarang extends Model
{
    use HasFactory;

    protected $table = 'surat_pengadaan_barang';

    protected $fillable = [
        'nomor_surat',
        'tujuan_surat',
        'nama_penanda_tangan',
        'tanggal_surat'
    ];

    // Mutator untuk tanggal_surat
    protected $casts = [
        'tanggal_surat' => 'datetime',
    ];

    public function asetPengadaan()
    {
        return $this->hasMany(AsetPengadaan::class, 'surat_pengadaan_barang_id', 'id');
    }
}
