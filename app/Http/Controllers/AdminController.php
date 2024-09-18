<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    //
    public function _construct()
    {
        $this->middleware('auth:admin-api', ['except' => ['adminlogin', 'adminregister']]);
    }


    public function adminlogin(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('admin-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized User'], 401);
        }
        return $this->respondWithToken($token);
    }


    protected function respondWithToken($token)
    {
        // $user = auth()->guard('admin-api')->user();
        $user = auth()->guard('admin-api')->user();
        $userData = $user->only('email', 'role', 'phone', 'name', 'location', 'sex',);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('admin-api')->factory()->getTTL() * 60,
            'user' => $userData


        ]);
    }



    public function logoutAdmin()
    {
        auth()->guard('admin-api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }




    public function loginUser(Request $request)
    {
        $credentials = request(['email', 'password']);
        // return $credentials;
        if (!$token = auth()->guard('user-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized Staff'], 401);
        }
        return $this->respondWithToken1($token);
    }


    protected function respondWithToken1($token)
    {
        // $user = auth()->guard('admin-api')->user();
        $user = auth()->guard('user-api')->user();
        $userData = $user->only('id', 'email', 'name', 'account_balance', 'last_transaction', 'nin', 'tin', 'staff_number', 'phone');

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('user-api')->factory()->getTTL() * 60,
            'user' => $userData


        ]);
    }




    public function authenticate(Request $request)
    {
        try {
            $formFields = [
                "email" => "admin@gmail.com",
                "password" => "123456"
            ];

            //  return   $formFields;
            // Attempt to authenticate the user
            if (Auth::guard('admin')->attempt($formFields)) {

                $request->session()->regenerate();
                // $cookie = request()->cookie('laravel_session');

                $sessionId = session();
                // dd($sessionId);
                //  dd($cookie);

                return 'yes';
            }

            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        } catch (\Exception $e) {
            // return $e;
            return back()->with('danger', 'something went wrong try again');
        }
    }



    public function login(Request $request, $type )
    {
        // $credentials = $request->only('email', 'password');
        $credentials = [
            "email" => "alfredkaziibwe19@gmail.com",
            "password" => "123456"
        ];

        if (Auth::guard($type)->attempt($credentials)) {

        $request->session()->regenerate();

        $sessionId = session();

        return view($type.'.index')->with('successs','Welcome to '.$type.' System as verified User!');


        }
        // return 'no';
        return back()->withErrors(['email'=>'invalid Credentials'])->onlyInput('email');


    }





    public function register(Request $request)
    {
        $formAddHomeAdvert = [
            'name' => 'user@gmail.com',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'), // Hash the password
        ];

        DB::table('vendors')->insert($formAddHomeAdvert);
        return 'success';
    }


    //

    public function userProfile()
    {
        return response()->json(auth()->guard('user-api')->user());
    }


    public function changePasswordUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User Not Found'], 401);
        }

        $data = $request->all();

        if (Hash::check($data['current_pwd'], $user->password)) {
            $user->update(['password' => bcrypt($data['new_pwd'])]);
            return response()->json(["message" => "Password changed successfully", 'status' => true], 200);
        } else {
            return response()->json(['message' => 'Current password is incorrect.'], 400);
        }
    }



}

