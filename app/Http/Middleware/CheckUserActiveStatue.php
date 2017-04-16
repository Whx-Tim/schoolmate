<?php

namespace App\Http\Middleware;

use App\Events\UserRegister;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserActiveStatue
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->is_active) {
            event(new UserRegister($request->user()->id, $request->user()->email));

            return response('账号未激活，请激活账号',422);
        }
    }
}
