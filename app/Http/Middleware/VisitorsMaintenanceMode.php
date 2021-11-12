<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VisitorsMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (cache('siteSettings')['maintenancemode'] === 'true') {
            return response()->view('maintenance.maintenance');
        } else {
            return $next($request);
        }
    }
}
