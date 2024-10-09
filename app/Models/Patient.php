<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'patients';
    protected $guarded = [];

    public $casts = [
        'nome'              => 'string' ,
        'raca'              => 'string' ,
        'especie'           => 'string' ,
        'peso'              => 'string' ,
        'tipoPeso'          => 'string' ,
        'coloracao'         => 'string' ,
        'idade'             => 'string' ,
        'tipoIdade'         => 'string' ,
        'procedencia'       => 'string' ,
        'motivoCadastro'    => 'string' ,
        'user_id'           => 'string' ,
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
