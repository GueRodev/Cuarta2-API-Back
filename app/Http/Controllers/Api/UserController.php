<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Mostrar información del usuario autenticado
     */
    public function show(Request $request): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $request->user(),
                ],
                'message' => 'Información del usuario obtenida exitosamente',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener información del usuario',
                'error' => app()->environment('local') ? $e->getMessage() : 'Error interno',
            ], 500);
        }
    }

    /**
     * Actualizar perfil del usuario autenticado
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id),
                ],
            ]);

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user->fresh(),
                ],
                'message' => 'Perfil actualizado exitosamente',
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el perfil',
                'error' => app()->environment('local') ? $e->getMessage() : 'Error interno',
            ], 500);
        }
    }
}