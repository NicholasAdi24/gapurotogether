<?php

namespace App\Models;

use App\Models\Spmielemen;
use App\Models\Spmiindikatorkomponen;
use App\Models\Spmiindikatorkualitatif;
use Illuminate\Database\Eloquent\Model;
use App\Models\Spmipenilaianindikatorscalc;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spmibobot extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_bobots';




}
