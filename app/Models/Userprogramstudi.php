<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Programstudi;

class Userprogramstudi extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_programstudis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['users_id', 'programstudis_id', 'status', 'tahun'];

    public function getProgramstudi()
    {
        return $this->belongsTo(Programstudi::class, 'programstudis_id');
    }
}
