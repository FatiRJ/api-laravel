<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $primaryKey = 'paciente_id';

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'paciente_id');
    }
}
