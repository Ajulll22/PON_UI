<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Http\Controllers\UtilityController;

class CheckSession
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
        if(empty(Session::get('user_email'))){
            $request->session()->flush();

            if ($request->ajax()) {
                return response()->json([ 'result' => 'Failed', 'message' => 'Session Expired', 'error' => 403 ], 403);
            }
            else {
                abort(403, 'Session Expired!');
            }
        }
        else{
            // CHECK FIRST TIME LOGIN
            if (session::get('user_first_login') == 1) {
                return redirect()->route('change-password');
            }
            else {
                return $next($request);
            }
        }
    }
}
