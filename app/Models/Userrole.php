<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userrole extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'roles_id',
        'status',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }
}
