<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{


    protected $table = 'asistente';
    protected $fillable = [
        'id', 'name', 'identification_card','birthdate','gender'
    ];
}
