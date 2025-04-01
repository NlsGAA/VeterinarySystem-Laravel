<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';
    
    public $incrementing = false;

    public $timestamps  = false;

    protected $table = 'patients';

    protected $guarded = [];

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'breed',
        'species',
        'weight',
        'weight_type',
        'color',
        'age',
        'age_type',
        'origin',
        'reason',
        'image',
        'situationId',
        'doctorId',
        'owner_id',
    ];

    public $casts = [
        'name'          => 'string',
        'breed'         => 'string',
        'species'       => 'string',
        'weight'        => 'string',
        'weight_type'   => 'string',
        'color'         => 'string',
        'age'           => 'string',
        'age_type'      => 'string',
        'origin'        => 'string',
        'reason'        => 'string',
        'user_id'       => 'string',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
