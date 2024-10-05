<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiAset extends Model
{
    use HasFactory;

    protected $table = 'kondisi_aset';

    protected $fillable = [
        'kondisi',
    ];

    public function asets()
    {
        return $this->hasMany(Aset::class, 'kondisi_aset');
    }
}
