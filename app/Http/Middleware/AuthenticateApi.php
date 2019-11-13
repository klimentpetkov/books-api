<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateApi
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
        /*if () {

        }*/
        $array = [
            'path' => $request->path(),
            'isCertainPath' => $request->is('test/request/1'),
            'url' => $request->url(),
            'fullUrl' => $request->fullUrl(),
            'method' => $request->method(),
            'isPost' => $request->isMethod('post')
        ];

        dd($array);

//        $now = \Carbon\Carbon::now(ini_get('date.timezone'));
//        $request->path()
//        $request->is('test/my')
//        $request->url()
//        $request->fullUrl()
//        $request->method()
//        $request->method
//        $request->is('test/request/1');
//        $request->isMethod('post') ? true : false;
//        $now = \Carbon\Carbon::now(ini_get('date.timezone'));
//        dd($now);
//        dd($request->bearerToken());
//        dd($request->user()->hasRole('admin'));

//        if (!$request->user() || !($request->user()->authorized_at))

//        if (!$request->bearerToken() || $request)
//        if ($this->auth->guard($guard)->check()) {
        // 10 minutes passed
        /*if ((strtotime($now) - strtotime($request->user()->authorized_at)) >= 600) {

        }*/

        return $next($request);
    }
}
