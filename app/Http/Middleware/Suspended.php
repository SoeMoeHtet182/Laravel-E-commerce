<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Suspended
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
        $user = auth()->user();
        if ($user->suspended !== 0) {
            return response([
                'message' => 'suspended',
                'data' => 'You have been banned. You can approve approval.'
            ]);
        }
        return $next($request);
    }
}
