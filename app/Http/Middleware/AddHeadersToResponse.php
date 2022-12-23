<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddHeadersToResponse
{
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);
        $response->header('X-Active-Custom-Cache', '1');

        return $response;
    }
}
