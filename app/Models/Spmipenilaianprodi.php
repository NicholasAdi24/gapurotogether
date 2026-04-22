<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmipenilaianprodi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_penilaianprodis';

    protected $fillable = [
        'programstudis_id',
        'spmi_periodes_id',
        'lembagas_id',
        'tahun',
        'nilai_prodi_final',
        'nilai_auditor_final',
        'skor_final',
        'status',
        'created_at',
        'updated_at',
        'auditor_id'
    ];


    public function programstudi()
    {
        return $this->belongsTo(Programstudi::class, 'programstudis_id');
    }

    public function spmiperiode()
    {
        return $this->belongsTo(Spmiperiode::class, 'spmi_periodes_id');
    }

    public function lembagas()
    {
        return $this->belongsTo(Lembaga::class, 'lembagas_id');
    }

}
