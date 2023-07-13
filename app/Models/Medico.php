<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $primaryKey = 'medico_id';
    protected $fillable = ['nombre', 'especialidad'];

    public function hospitales()
    {
        return $this->belongsToMany(Hospital::class, 'hospitales_medicos', 'medico_id', 'hospital_id');
    }
}
