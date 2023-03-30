<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;

    protected $table = 'capacitaciones';

    protected $fillable = [
        'nombre',
        'cupo',
        'numero_inscripciones',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado'
    ];
}
