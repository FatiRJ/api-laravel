<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $primaryKey = 'departamento_id';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];
    
    public function hospitales()
    {
        return $this->belongsToMany(Hospital::class, 'hospitales_departamentos', 'departamento_id', 'hospital_id');
    }
}
