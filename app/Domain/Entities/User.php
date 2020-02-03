<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'identification',
        'job_role'
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function refunds()
    {
        return $this->hasMany(Refunds::class, 'user_id', 'id');
    }

}
