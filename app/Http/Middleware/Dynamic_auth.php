<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Permissions\Permission;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Dynamic_auth
{
    protected $permission;
    public function __construct(
        Permission $permission

    )
    {
     $this->permission=$permission;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        // $user = Auth::user();
        // $type = $request->route('type'); // Get the 'type' parameter from the route
        $currentPath = $request->path();
        $currentPath = str_replace('api/', '', $currentPath); // Now it becomes "post-all/admin"

        $parts = explode('/', $currentPath);

                $currentPath =  $parts[2].'/'. $parts[3];

       $accessUser =  $parts[1];
    //    dd($accessUser);

        $authenticatedUser = Auth::guard($accessUser.'-api')->user();


        if (!$authenticatedUser) {
            return response()->json(['status' => false, 'message' => 'Unauthorized User'], 403);
        }

        // Call a method to check if the user has access based on the type

            if (!$this->hasAccess($authenticatedUser, $accessUser, $currentPath)) {
                return response()->json(['status' => false, 'message' => 'Unauthorized permission '], 403);
            }


        return $next($request);
    }

    protected function hasAccess($authenticatedUser, $accessUser, $currentPath)
    {
        // Example: Define permission rules based on the accessUser
       $permissions = $this->permission->permission();


        // Check if the accessUser exists in the permissions array
        if (array_key_exists($accessUser, $permissions)) {
            // Check if the current path is allowed for this accessUser
            foreach ($permissions[$accessUser] as $allowedPath) {
                if (str_contains($currentPath, $allowedPath)) {
                    return true;
                }
            }
        }

        return false;
    }
}
