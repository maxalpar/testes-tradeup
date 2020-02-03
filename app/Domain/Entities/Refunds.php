<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refunds extends Model
{
    use SoftDeletes;

    protected $table = 'refunds';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'date',
        'type',
        'description',
        'value',
        'approved',
    ];

    public function refunds()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

}
