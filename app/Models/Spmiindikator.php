<?php

namespace App\Models;

use App\Models\Spmielemen;
use App\Models\Spmibobot;
use App\Models\Spmiindikatorkomponen;
use App\Models\Spmiindikatorkualitatif;
use Illuminate\Database\Eloquent\Model;
use App\Models\Spmipenilaianindikatorscalc;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spmiindikator extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_indikators';

    public function getSpmielemen()
    {
        return $this->belongsTo(Spmielemen::class, 'spmi_elemens_id');
    }

    public function getIndikatorkomponen()
    {
        return $this->HasMany(Spmiindikatorkomponen::class, 'spmi_indikators_id');
    }

    public function getSpmibobot()
    {
        return $this->HasMany(Spmibobot::class, 'spmi_indikators_id');
    }

    public function getIndikatorkualitatif()
    {
        return $this->HasMany(Spmiindikatorkualitatif::class, 'spmi_indikators_id');
    }

    public function getIndikatorsub()
    {
        return $this->HasMany(Spmiindikatorsub::class, 'spmi_indikators_id');
    }


}
