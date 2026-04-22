<?php

namespace App\Models;

use App\Models\Spmiindikator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spmielemen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spmi_elemens';

    public function getSpmiIndikator()
    {
        return $this->HasMany(Spmiindikator::class, 'spmi_elemens_id');
    }
}
