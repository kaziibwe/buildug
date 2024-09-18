<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {

    //     return $request->expectsJson() ? null : route('login');
    // return $request->expectsJson() ? null : null;


    // }

    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }
        $currentPath = $request->path();
        $currentPath = str_replace('api/', '', $currentPath); // Now it becomes "post-all/admin"

        $parts = explode('/', $currentPath);

                $currentPath =  $parts[2].'/'. $parts[3];

       $accessUser =  $parts[1];
        // Determine the user type (this is an example; adapt as needed)
        // $type = $request->route('type') ?? 'login'; // Default to 'default' or another fallback type

        // Ensure the route exists before redirecting
        $route = route('login.'.$accessUser, ['type' => $accessUser]);

        // Redirect to the login page based on the type
        return $route;
    }


}
