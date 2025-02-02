<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;

    protected $table = 'reason_type';

    protected $casts = [
        'id' => 'integer',
        'description' => 'string'
    ];

    public function patient()
    {
        return $this->hasMany('App\Models\Patient');
    }
}
