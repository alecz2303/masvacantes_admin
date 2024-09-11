<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmpresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // Obtén el usuario autenticado
        $user = Auth::user();

        if ($user && $user->role_id === null) {
            // Usar la ruta logout
            Auth::logout();
            return redirect()->away('https://candidato.masvacantes.com/login');
        }

        if ($user && $user->role->name === 'Empresa') {
            // Excluye la ruta de creación de empresa de la verificación
            if ($request->is('admin/empresas/create') || $request->is('admin/logout') || $request->is('admin/empresas*')) {
                return $next($request);
            }

            // Verifica si hay registros en la tabla de Empresas
            if (!Empresa::where('user_id', $user->id)->exists()) {
                // Si no hay registros, redirige a una vista específica
                return redirect()->route('voyager.empresas.create')->with([
                    'message'    => __('Es necesario crear una Empresa.'),
                    'alert-type' => 'warning',
                ]); // Cambia 'empresa.create' al nombre de la ruta de la vista que deseas mostrar
            }

        }

        return $next($request);
    }
}
