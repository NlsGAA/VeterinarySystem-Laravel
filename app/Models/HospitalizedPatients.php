<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalizedPatients extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hospitalization';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'situation_id',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $cast = [
        'patient_id' => 'integer|required',
        'doctor_id' => 'integer|required',
        'situation_id' => 'integer|required',
        'updated_by' => 'integer|nullable',
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'deleted_at' => 'datetime:d-m-Y'
    ];
}
