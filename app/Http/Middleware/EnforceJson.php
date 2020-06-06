<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnforceJson
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->add(['Accept' => 'application/json']);

        return $next($request);
    }
}
