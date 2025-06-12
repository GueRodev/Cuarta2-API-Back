<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MateriaController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Rutas públicas (sin autenticación)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->group(function () {
    
    // ===== RUTAS DE AUTENTICACIÓN EXISTENTES =====
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/verify-token', [AuthController::class, 'verifyToken']);

    // Agregar estas rutas dentro del grupo middleware('auth:sanctum')
    Route::prefix('user')->group(function () {
        Route::get('/profile', [UserController::class, 'show']);
        Route::put('/profile', [UserController::class, 'update']);
    });
    
    // ===== NUEVAS RUTAS DE MATERIAS =====
    Route::prefix('materias')->group(function () {
        
        // Rutas especiales (deben ir antes que las dinámicas)
        Route::get('/estadisticas', [MateriaController::class, 'estadisticas']);
        Route::get('/carrera/{carrera}', [MateriaController::class, 'porCarrera']);
        
        // CRUD básico usando código como identificador
        Route::get('/', [MateriaController::class, 'index']);           // GET /api/materias
        Route::post('/', [MateriaController::class, 'store']);          // POST /api/materias
        Route::get('/{codigo}', [MateriaController::class, 'show']);    // GET /api/materias/{codigo}
        Route::put('/{codigo}', [MateriaController::class, 'update']);  // PUT /api/materias/{codigo}
        Route::delete('/{codigo}', [MateriaController::class, 'destroy']); // DELETE /api/materias/{codigo}
    });
    
    // ===== AQUÍ PUEDES AGREGAR MÁS MÓDULOS EN EL FUTURO =====
    // Route::prefix('estudiantes')->group(function () {
    //     Route::get('/', [EstudianteController::class, 'index']);
    //     Route::post('/', [EstudianteController::class, 'store']);
    //     // ... más rutas
    // });
    
    // Route::prefix('carreras')->group(function () {
    //     Route::get('/', [CarreraController::class, 'index']);
    //     Route::post('/', [CarreraController::class, 'store']);
    //     // ... más rutas
    // });
});

// Ruta de fallback para endpoints no encontrados
Route::fallback(function () {
    return response()->json([
        'message' => 'Endpoint no encontrado. Verifica la URL y el método HTTP.',
        'status' => 'error',
        'available_endpoints' => [
            'auth' => [
                'POST /api/register',
                'POST /api/login', 
                'GET /api/logout',
                'GET /api/user',
                'GET /api/verify-token'
            ],
            'materias' => [
                'GET /api/materias',
                'POST /api/materias',
                'GET /api/materias/{codigo}',
                'PUT /api/materias/{codigo}',
                'DELETE /api/materias/{codigo}',
                'GET /api/materias/carrera/{carrera}',
                'GET /api/materias/estadisticas'
            ]
        ]
    ], 404);
});