<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DatabaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            // $tenants = DB::table('tenants')->get();
            $tenants = DB::table('laravel_tasks.tenant_users')
                ->select('laravel_tasks.tenant_users.global_user_id', 'laravel_tasks.tenants.data', 'laravel_tasks.tenants.id AS tenant')
                ->join('laravel_tasks.tenants', 'tenants.id', '=', 'tenant_users.tenant_id')
                ->where('tenant_users.global_user_id', '=', auth()->user()->global_id)
                ->get();

            foreach ($tenants as $tenant) {
                $databaseName = json_decode($tenant->data)->tenancy_db_name;
                $name = "database.connections." . $databaseName;
                // Configurar la conexión de base de datos para el inquilino actual
                config([
                    $name => [
                        'driver' => 'mysql',
                        'database' => $databaseName,
                        'host' => env('DB_HOST', '127.0.0.1'),
                        'port' => env('DB_PORT', '3306'),
                        'username' => env('DB_USERNAME', 'forge'),
                        'password' => env('DB_PASSWORD', ''),
                    ],
                ]);
            }
        }

        return $next($request);
    }
}
