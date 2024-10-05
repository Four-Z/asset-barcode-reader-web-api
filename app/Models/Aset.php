<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aset extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'id_barcode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_barcode',
        'nama_aset',
        'merk_aset',
        'tahun_beli',
        'harga_beli',
        'kondisi_aset',
        'lokasi_aset',
        'keterangan',
    ];

    protected $dates = ['deleted_at'];

    public function kondisiAset()
    {
        return $this->belongsTo(KondisiAset::class, 'kondisi_aset');
    }
}
