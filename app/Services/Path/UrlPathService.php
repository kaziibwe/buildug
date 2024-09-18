<?php

// namespace  App\Services\Path;

// use Illuminate\Http\Request;
// use App\Services\Access\AuthService;

// class UrlPathService
// {
//     //declare the valiable
//     protected $authService;

//     public function __construct(        // $this->urlPathService->path($request, $type); //return 1 it has passed

//         AuthService $authService,
//     )
//     {
//         $this->authService = $authService;
//     }
//     public function path(Request $request, $type)
//     {
//         // $currentUrl = URL::current(); // Full URL (e.g., http://your-domain.com/post-all/admin)
//         $currentPath = $request->path(); // Path only (e.g., post-all/admin)

//         // remove api/
//         $currentPath = str_replace('api/', '', $currentPath); // Now it becomes "post-all/admin"
//         // return $currentPath;
//         $parts = explode('/', $currentPath);
//         if (count($parts) === 2) {

//             // This is for paths like 'post-all/admin'
//             $result =  $this->authService->authAccess($request, null, $type, $currentPath);
//             if (!($result == $currentPath)) {
//                 return  $result;
//             }
//         } elseif (count($parts) === 3) {

//             // This is for paths like 'update-all/admin/1 or update-all/user/1 or update-all/attendances/1' or get/user/1  or get/attendance/1
//             $currentPath = $parts[0] . '/' . $parts[1];
//             // return $currentPath;
//          return   $result =  $this->authService->authAccess($request, null, $type, $currentPath);
//             if (!($result == $currentPath)) {
//                 return  $result;
//             }
//         } else {
//             // Handle other cases if necessary
//             return null;
//         }
//     }
// }
