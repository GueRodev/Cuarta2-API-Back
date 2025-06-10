<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'materias';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'creditos',
        'requisitos',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'creditos' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'codigo'; // Usar código en lugar de ID para las rutas
    }
}