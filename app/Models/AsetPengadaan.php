<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetPengadaan extends Model
{
    use HasFactory;

    protected $table = 'aset_pengadaan';

    protected $fillable = [
        'kode_barang',
        'rincian',
        'jumlah',
        'surat_pengadaan_barang_id'
    ];

    public function suratPengadaanBarang()
    {
        return $this->belongsTo(SuratPengadaanBarang::class, 'surat_pengadaan_barang_id', 'id');
    }

}
