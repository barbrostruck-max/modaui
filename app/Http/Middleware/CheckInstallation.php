<?php

namespace App\Http\Middleware;

use App\Helpers\Classes\Helper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use PDOException;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (! Helper::dbConnectionStatus()) {
                return redirect('/installer');
            }

            static $hasUsersTable;
            if ($hasUsersTable === null) {
                $hasUsersTable = Schema::hasTable('users');
            }

            return $hasUsersTable ? $next($request) : redirect('/installer');
        } catch (PDOException $e) {
            return redirect('/installer');
        }
    }
}
