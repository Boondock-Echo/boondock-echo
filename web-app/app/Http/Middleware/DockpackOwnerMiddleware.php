<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Dockpack;

class DockpackOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $dockpackId = $request->route('id');
        $dockpack = Dockpack::find($dockpackId);
    
        // Check if the dockpack exists
        if (!$dockpack) {
            abort(404 , 'notfound');
        }
    
        // Check if the authenticated user is the owner of the dockpack
        if ($dockpack->owner != auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
    
        return $next($request);
    }
    
}
