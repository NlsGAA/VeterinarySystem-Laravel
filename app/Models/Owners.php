<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
    use HasFactory;

    protected $table = 'owners_data';

    public $fillable = [
        'firstName',
        'lastName',
        'cpf',
        'email',
        'cellphone',
        'cellphone2',
        'address',
    ];

    public $casts = [
        'firstName'     => 'string' ,
        'lastName'      => 'string' ,
        'cpf'           => 'integer' ,
        'email'         => 'string' ,
        'cellphone'     => 'integer' ,
        'cellphone2'    => 'integer' ,
        'address'       => 'string' ,
    ];

    public static $rules = [
        'firstName'     => 'required' ,
        'lastName'      => 'required' ,
        'cpf'           => 'required' ,
        'email'         => 'required' ,
        'cellphone'     => 'nullable' ,
        'cellphone2'    => 'nullable' ,
        'address'       => 'required' ,
    ];

    public function findBy(string $column, string $value){
        dd( $this->findBy($column, $value));
    }

    public function patients(){
        return $this->hasMany(Patient::class, 'patient_id', 'id');
    }

}
