<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmiindikatorkomponen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_indikatorkomponens';

    // public function getpIndikatorkomponen()
    // {
    //     return $this->HasMany(Spmipindikatorkomponen::class, 'spmi_indikatorkomponens_id');
    // }

    public function getIndikatorsub()
    {
        return $this->belongsTo(Spmiindikatorsub::class, 'spmi_indikatorsubs_id');
    }


}
