<?php


// namespace App\Services\Access;

// use Illuminate\Http\Request;


// class CheckAuthSwitchService
// {

//     public function  checkAuthSwitch(Request $request, $authorisedAccess, $type)
//     {


//         switch ($type) {
//             case 'admin':   //for table admins
//                 return [
//                     'post-all/admin',
//                     'post-all/user',
//                     'update-all/admin',
//                     'update-all/user',
//                     'update-all/attendance',
//                     'get-all/admin',
//                     'get-all/user',
//                     'get-all/attendance',




//                 ];
//             case 'user':  //for table users
//                 return [
//                     'post-all/admin',
//                     'post-all/user',
//                     'post-all/attendance',
//                     'update-all/user',
//                     'update-all/attendance',
//                     'get-all/user',
//                     'get/user',
//                     'get-all/attendance',
//                 ];

//             default:
//                 return [];
//         }
//     }
// }
