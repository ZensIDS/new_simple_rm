<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['usia'];

    public function Riwayat()
    {
        return $this->hasMany(Riwayat::class);
    }

    public function getUsiaAttribute()
    {
        try {
            $years = Carbon::parse($this->umur)->diff(\Carbon\Carbon::now())->format('%y, %m');
            return $years;
        } catch (\Throwable $th) {
            return '-';
        }
    }
}
