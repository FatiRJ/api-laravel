<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// routes/api.php
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DepartamentoController;

Route::get('hospitales', [HospitalController::class, 'index']);              // Obtener todos los hospitales
Route::post('hospitales', [HospitalController::class, 'create']);             // Crear un nuevo hospital
Route::get('hospitales/{id}', [HospitalController::class, 'show']);           // Obtener un hospital por ID
Route::put('hospitales/{id}', [HospitalController::class, 'update']);         // Actualizar un hospital por ID
Route::delete('hospitales/{id}', [HospitalController::class, 'destroy']);     // Eliminar un hospital por ID

Route::get('medicos', [MedicoController::class, 'index']);              // Obtener todos los medicos
Route::post('medicos', [MedicoController::class, 'create']);             // Crear un nuevo Medico
Route::get('medicos/{id}', [MedicoController::class, 'show']);           // Obtener un Medico por ID
Route::put('medicos/{id}', [MedicoController::class, 'update']);         // Actualizar un Medico por ID
Route::delete('medicos/{id}', [MedicoController::class, 'destroy']);     // Eliminar un Medico por ID

Route::get('pacientes', [PacienteController::class, 'index']);              // Obtener todos los pacientes
Route::post('pacientes', [PacienteController::class, 'create']);             // Crear un nuevo Paciente
Route::get('pacientes/{id}', [PacienteController::class, 'show']);           // Obtener un Paciente por ID
Route::put('pacientes/{id}', [PacienteController::class, 'update']);         // Actualizar un Paciente por ID
Route::delete('pacientes/{id}', [PacienteController::class, 'destroy']);     // Eliminar un Paciente por ID

Route::get('consultas', [ConsultaController::class, 'index']);              // Obtener todos los consultas
Route::post('consultas', [ConsultaController::class, 'create']);             // Crear un nuevo Consulta
Route::get('consultas/{id}', [ConsultaController::class, 'show']);           // Obtener un Consulta por ID
Route::put('consultas/{id}', [ConsultaController::class, 'update']);         // Actualizar un Consulta por ID
Route::delete('consultas/{id}', [ConsultaController::class, 'destroy']);     // Eliminar un Consulta por ID

Route::get('departamentos', [DepartamentoController::class, 'index']);              // Obtener todos los departamentos
Route::post('departamentos', [DepartamentoController::class, 'create']);             // Crear un nuevo Departamento
Route::get('departamentos/{id}', [DepartamentoController::class, 'show']);           // Obtener un Departamento por ID
Route::put('departamentos/{id}', [DepartamentoController::class, 'update']);         // Actualizar un Departamento por ID
Route::delete('departamentos/{id}', [DepartamentoController::class, 'destroy']);     // Eliminar un Departamento por ID