<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MateriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
            'creditos' => $this->creditos,
            'requisitos' => $this->requisitos,
            'carrera' => $this->obtenerCarrera(),
            'carrera_nombre' => $this->obtenerNombreCarrera(),
            'nivel' => $this->obtenerNivel(),
            'es_practica' => $this->esPractica(),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'created_at_human' => $this->created_at?->diffForHumans(),
            'updated_at_human' => $this->updated_at?->diffForHumans(),
        ];
    }

    /**
     * Obtener el código de carrera basado en el prefijo
     */
    private function obtenerCarrera(): string
    {
        $partes = explode('-', $this->codigo);
        return $partes[0] ?? '';
    }

    /**
     * Obtener el nombre completo de la carrera
     */
    private function obtenerNombreCarrera(): string
    {
        $carrera = $this->obtenerCarrera();
        
        $carreras = [
            'IN' => 'Ingeniería en Sistemas',
            'AD' => 'Administración de Empresas',
            'CO' => 'Contabilidad',
            'PC' => 'Práctica Contable',
            'AU' => 'Auditoría',
            'EC' => 'Economía',
            'ID' => 'Idiomas',
            'PP' => 'Práctica Profesional',
            'MI' => 'Metodología de Investigación'
        ];

        return $carreras[$carrera] ?? 'Sin clasificar';
    }

    /**
     * Obtener el nivel basado en el número del código
     */
    private function obtenerNivel(): int
    {
        $partes = explode('-', $this->codigo);
        if (count($partes) < 2) return 0;
        
        $numero = $partes[1];
        $primerDigito = (int) substr($numero, 0, 1);
        
        return $primerDigito;
    }

    /**
     * Determinar si es una materia de práctica
     */
    private function esPractica(): bool
    {
        $nombreLower = strtolower($this->nombre);
        
        return str_contains($nombreLower, 'práctica') || 
               str_contains($nombreLower, 'practica') ||
               str_contains($nombreLower, 'trabajo de graduación') ||
               str_contains($nombreLower, 'metodología de la investigación');
    }

    /**
     * Customize the outgoing response for the resource.
     */
    public function with(Request $request): array
    {
        return [
            'status' => 'success',
            'timestamp' => now()->toISOString(),
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function additional(array $data): static
    {
        return parent::additional(array_merge([
            'status' => 'success',
            'timestamp' => now()->toISOString(),
        ], $data));
    }
}