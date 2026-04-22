<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmeakreditasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spme_akreditasis';

    public function Getprogramstudi()
    {
        return $this->belongsTo(Programstudi::class, 'programstudis_id');
    }
}
