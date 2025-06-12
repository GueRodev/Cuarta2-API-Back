<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MateriaResource;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Materia::query();

        // Búsqueda por nombre o código
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('codigo', 'LIKE', "%{$search}%");
            });
        }

        // Filtro por créditos
        if ($request->has('creditos')) {
            $query->where('creditos', $request->creditos);
        }

        // Filtro por carrera (basado en prefijo del código)
        if ($request->has('carrera')) {
            $carrera = $request->carrera;
            $query->where('codigo', 'LIKE', "{$carrera}-%");
        }

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'codigo');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginación
        $perPage = $request->get('per_page', 15);
        $materias = $query->paginate($perPage);

        return MateriaResource::collection($materias)->additional([
            'message' => 'Materias obtenidas exitosamente',
            'total' => $materias->total()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'codigo' => 'required|string|max:20|unique:materias,codigo',
            'creditos' => 'required|integer|min:1|max:10',
            'requisitos' => 'nullable|string|max:255'
        ], [
            'nombre.required' => 'El nombre de la materia es obligatorio',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres',
            'codigo.required' => 'El código de la materia es obligatorio',
            'codigo.unique' => 'Este código ya existe',
            'codigo.max' => 'El código no puede exceder 20 caracteres',
            'creditos.required' => 'Los créditos son obligatorios',
            'creditos.integer' => 'Los créditos deben ser un número entero',
            'creditos.min' => 'Los créditos deben ser al menos 1',
            'creditos.max' => 'Los créditos no pueden exceder 10',
            'requisitos.max' => 'Los requisitos no pueden exceder 255 caracteres'
        ]);

        $materia = Materia::create($validated);

        return new MateriaResource($materia);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $codigo)
    {
        $materia = Materia::where('codigo', $codigo)->firstOrFail();
        
        return new MateriaResource($materia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $codigo)
    {
        $materia = Materia::where('codigo', $codigo)->firstOrFail();

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'codigo' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('materias', 'codigo')->ignore($materia->id)
            ],
            'creditos' => 'sometimes|required|integer|min:1|max:10',
            'requisitos' => 'nullable|string|max:255'
        ], [
            'nombre.required' => 'El nombre de la materia es obligatorio',
            'nombre.max' => 'El nombre no puede exceder 100 caracteres',
            'codigo.required' => 'El código de la materia es obligatorio',
            'codigo.unique' => 'Este código ya existe',
            'codigo.max' => 'El código no puede exceder 20 caracteres',
            'creditos.required' => 'Los créditos son obligatorios',
            'creditos.integer' => 'Los créditos deben ser un número entero',
            'creditos.min' => 'Los créditos deben ser al menos 1',
            'creditos.max' => 'Los créditos no pueden exceder 10',
            'requisitos.max' => 'Los requisitos no pueden exceder 255 caracteres'
        ]);

        $materia->update($validated);

        return new MateriaResource($materia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $codigo)
    {
        $materia = Materia::where('codigo', $codigo)->firstOrFail();
        
        $materia->delete();

        return response()->json([
            'message' => 'Materia eliminada exitosamente',
            'data' => new MateriaResource($materia)
        ], Response::HTTP_OK);
    }

    /**
     * Buscar materias por carrera
     */
    public function porCarrera(string $carrera)
    {
        $materias = Materia::where('codigo', 'LIKE', "{$carrera}-%")
                          ->orderBy('codigo')
                          ->get();

        return MateriaResource::collection($materias)->additional([
            'message' => "Materias de la carrera {$carrera} obtenidas exitosamente",
            'carrera' => $carrera,
            'total' => $materias->count()
        ]);
    }

    /**
     * Estadísticas de materias
     */
    public function estadisticas()
    {
        $stats = [
            'total_materias' => Materia::count(),
            'por_carrera' => [
                'IN' => Materia::where('codigo', 'LIKE', 'IN-%')->count(),
                'AD' => Materia::where('codigo', 'LIKE', 'AD-%')->count(),
                'CO' => Materia::where('codigo', 'LIKE', 'CO-%')->count(),
                'PC' => Materia::where('codigo', 'LIKE', 'PC-%')->count(),
                'AU' => Materia::where('codigo', 'LIKE', 'AU-%')->count(),
                'EC' => Materia::where('codigo', 'LIKE', 'EC-%')->count(),
                'ID' => Materia::where('codigo', 'LIKE', 'ID-%')->count(),
                'PP' => Materia::where('codigo', 'LIKE', 'PP-%')->count(),
                'MI' => Materia::where('codigo', 'LIKE', 'MI-%')->count(),
            ],
            'por_creditos' => Materia::selectRaw('creditos, COUNT(*) as cantidad')
                                   ->groupBy('creditos')
                                   ->orderBy('creditos')
                                   ->pluck('cantidad', 'creditos'),
            'promedio_creditos' => round(Materia::avg('creditos'), 2)
        ];

        return response()->json([
            'message' => 'Estadísticas obtenidas exitosamente',
            'data' => $stats
        ]);
    }
}