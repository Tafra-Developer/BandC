<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
        // if(session()->has('locale'))
        // {
        //     app()->setlocale(session()->get('locale'));
        // }
        // return $next($request);

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            $availableLangs = ['ar', 'en'];
            $userLangs = preg_split('/,|;/', $request->server('HTTP_ACCEPT_LANGUAGE'));

            foreach ($availableLangs as $lang) {
                if (in_array($lang, $userLangs)) {
                    App::setLocale($lang);
                    Session::put('locale', $lang);
                    break;
                }
            }
        }

        return $next($request);
    }
}
