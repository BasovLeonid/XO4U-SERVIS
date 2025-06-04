<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PartnerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isPartner()) {
            abort(403, 'Доступ запрещен');
        }

        return $next($request);
    }
} 