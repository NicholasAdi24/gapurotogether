<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spmirtlprob extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_rtlprob';

    protected $fillable = [
        'kategori',
        'nilai',
        'keterangan',
        'status',
    ];


}
