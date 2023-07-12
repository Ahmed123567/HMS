<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isManager
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if(! auth()->user()?->isManager()) {
            return back()->with("error", "unAuthraized");
        }
        return $next($request);
    }
}
