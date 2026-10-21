<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function Dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}
