<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spmirtl extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_rtl';

    protected $fillable = [
        'spmi_penilaianindikatorscalc_id',
        'program_kerja',
        'target',
        'capaian',
        'deskripsi_risiko',
        'pengendalian',
        'akar_masalah',
        'kategori_risiko',
        'satuan',
        'probability',
        'severity',
        'rtl',
        'anggaran',
        'bukti',
        'feedback_prodi',
        'selesai',
        'pic',
        'persetujuan',
        'status',
        'created_at',
        'updated_at'
    ];


}
