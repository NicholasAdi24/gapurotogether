<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmiperiode extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_periodes';

    public function penilaians()
    {
        return $this->hasMany(Spmipenilaianprodi::class, 'spmi_periodes_id');
    }
}
