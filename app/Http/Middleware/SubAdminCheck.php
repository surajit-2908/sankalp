<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubAdminCheck
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
        if (auth()->user()->admin_type == 'A') {
            return $next($request);
        }
        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "You don't  have permission to access this page."
            ]
        ]);
    }
}
