<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $primaryKey = 'hospital_id';
    protected $table = 'hospitales';


    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'hospitales_departamentos', 'hospital_id', 'departamento_id');
    }

    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'hospitales_medicos', 'hospital_id', 'medico_id');
    }

    public function hospitales()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}