<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmipenilaianindikatorscalc extends Model
{
    use HasFactory;

    protected $table = 'spmi_penilaianindikatorscalc';

    protected $fillable = [
        'spmi_penilaianprodis_id',
        'spmi_indikators_id',
        'nilai_prodi',
        'nilai_auditor',
        'status',
    ];

    // Relasi ke Spmipenilaianprodi
    public function penilaianprodi()
    {
        return $this->belongsTo(Spmipenilaianprodi::class, 'spmi_penilaianprodis_id');
    }

    // Relasi ke Spmiindikator
    public function indikator()
    {
        return $this->belongsTo(Spmiindikator::class, 'spmi_indikators_id');
    }

    // Relasi ke Spmirtl
    public function getrtl()
    {
        return $this->HasOne(Spmirtl::class, 'spmi_penilaianindikatorscalc_id');
    }
}
