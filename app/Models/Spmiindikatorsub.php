<?php

namespace App\Models;

use App\Models\Spmiindikatorkomponen;
use App\Models\Spmipenilaianindikator;
use App\Models\Spmiindikatorkualitatif;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spmiindikatorsub extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_indikatorsubs';

    public function getIndikatorsubkomponen()
    {
        return $this->HasMany(Spmiindikatorkomponen::class, 'spmi_indikatorsubs_id');
    }

    public function getKualitatif()
    {
        return $this->HasMany(Spmiindikatorkualitatif::class, 'spmi_indikatorsubs_id');
    }

    public function getPenilaianindikator()
    {
        return $this->HasMany(Spmipenilaianindikator::class, 'spmi_indikatorsubs_id');
    }







}
