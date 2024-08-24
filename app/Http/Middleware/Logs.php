<?php

namespace App\Http\Middleware;

use App\Models\UserLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Logs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        UserLog::create([
            'user_id' => $request->user()?->id,
            'path' => $request->path(),
            'method'=>$request->method(),
            'ip'=>$request->ip(),
        ]);
        return $next($request);
    }
}
