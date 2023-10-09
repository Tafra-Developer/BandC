<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;

class autoCheckPermission
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
        $route = $request->route()->getName();
        $modules_activation = explode('.' , $request->route()->getName())[0];

        if( array_key_exists($modules_activation , config('cms.modules_activation')) && !config('cms.modules_activation.'.$modules_activation))
        {
            return abort(404);
        }

        $permission = \Spatie\Permission\Models\Permission::whereRaw("FIND_IN_SET('$route',routes)")->first();

        if($permission)
        {
            if(!auth()->user()->can($permission->name))
            {
                abort(403);
            }
        }
        return $next($request);
    }
}
