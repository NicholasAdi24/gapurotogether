<?php

namespace App\Models;

use App\Models\Spmikategorijenistemuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spmipenilaianindikator extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_penilaianindikators';

    protected $fillable = [
        'spmi_penilaianprodis_id',
        'spmi_indikators_id',
        'spmi_indikators_id',
        'spmi_kategorijenistemuans_id',
        'nilai_prodi',
        'nilai_auditor',
        'skor_bobot',
        'berkas',
        'link',
        'catatan_prodi',
        'catatan_auditor',
        'apresiasi_pelampauan',
        'deskripsi_temuan',
        'dampak_temuan',
        'akar_masalah_temuan',
        'rekomendasi_temuan',
        'feedback_prodi',
        'tindak_lanjut',
        'status',
        'perhatian',
        'created_at',
        'created_at',
        'updated_at'
    ];

    public function getIndikatorsubkomponen()
    {
        return $this->HasMany(Spmipindikatorkomponen::class, 'spmi_penilaianindikators_id');
    }

    public function programstudi()
    {
        return $this->belongsTo(Programstudi::class, 'programstudis_id');
    } // Kebutuhan Role Dekan dan Wadek

    public function getKategori()
    {
        return $this->belongsTo(Spmikategorijenistemuan::class, 'spmi_kategorijenistemuans_id');
    }
}
