<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ReqiredPasswordChange
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

        $result = User::check_if_required_to_change_password($request->user()->id);

        if (isset($result[0]->change))
        {
            if ($result[0]->change == 1)
            {
                return redirect()->route('password_update');
            }
        }

        return $next($request);
    }
}
