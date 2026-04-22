<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fakultas;
use App\Models\Strata;
use App\Models\Spmeakreditasi;

class Programstudi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'programstudis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fakultass_id',
        'departemens_id',
        'stratas_id',
        'kode_prodi',
        'nama_prodi',
        'status',
    ];

    public function getfakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultass_id');
    }

    public function getstrata()
    {
        return $this->belongsTo(Strata::class, 'stratas_id');
    }

    public function getAkreditasi()
    {
        return $this->HasMany(Spmeakreditasi::class, 'programstudis_id');
    }

    public function spmipenilaianprodi()
    {
        return $this->hasMany(Spmipenilaianprodi::class, 'programstudis_id');
    }
}
