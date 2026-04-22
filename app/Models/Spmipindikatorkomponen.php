<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmipindikatorkomponen extends Model
{
    use HasFactory;

    protected $table = 'spmi_pindikatorkomponens';

    public function getIndikatorkomponen()
    {
        return $this->belongto(Spmiindikatorkomponen::class, 'spmi_indikatorkomponens_id');
    }
}
