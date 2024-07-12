<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientStatusLog extends Model
{
    use HasFactory;

    protected $table = 'patient_status_logs';

    protected $fillable = [
        'status',
        'patient_id',
        'user_id'
    ];

    protected $cast = [
        'status' => 'string',
        'patient_id' => 'string',
        'user_id' => 'string'
    ];
}
