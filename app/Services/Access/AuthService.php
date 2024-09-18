<?php

// namespace App\Services\Access;

// use Illuminate\Http\Request;
// use App\Services\Access\CheckAuthSwitch;


// class AuthService {

//     protected $checkAuthSwitchService;

//     public function __construct(CheckAuthSwitchService $checkAuthSwitchService)
//     {
//         $this->checkAuthSwitchService=$checkAuthSwitchService;
//     }


//     // check for the authorised access . it return an with path that are authorised to the current user
//     public function  authAccess(Request $request, $value, $type, $currentPath)
//     {

//         $returnedAccess = $this->checkAuthSwitchService->checkAuthSwitch($request, $authorisedAccess = null, $type);

//         // make the array form the switch collection
//         $collection = collect($returnedAccess);

//         $value = $currentPath; // Define and assign a value to the $currentPath variable

//         // check whether the value is with in the collection
//         if ($collection->contains($value)) {
//             return $value; // Return the value if it exists in the collection
//             // api/post-all/admin=checked
//         } else {
//             return response()->json(['status' => false, 'message' => 'Unauthorized access'], 401);
//         }
//     }




// }
