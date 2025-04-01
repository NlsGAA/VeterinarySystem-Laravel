<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientStatusLog extends Model
{
    use HasFactory;

    protected $table = 'patient_status_logs';

    protected $dates = ['created_at'];

    protected $fillable = [
        'status',
        'patient_id',
        'user_id',
        'message',
        'created_at',
    ];

    protected $cast = [
        'status'     => 'string',
        'patient_id' => 'string',
        'user_id'    => 'string',
        'message'    => 'string',
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];
}
