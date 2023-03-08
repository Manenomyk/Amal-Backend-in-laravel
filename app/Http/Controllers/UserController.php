<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validation of the user data 
      
$validated=$request->validate([
    'name'=>'required',
    'email'=>'required|email|unique:users,email',
    'phone_number'=>'required',
    'password'=>'required',
]);

        try {
            $user = User::create([
                'role' => 1,
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' =>Hash::make($request->password),
            ]);
            return response()->json(['message' => 'user registered successfully',],200);
        } catch (\Throwable $th) {
            return response()->json([$th]);
        }
    }
    public function login(Request $request)
    {
        $validated=$request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = User::where('email',$request->email)->first();
            $token=$user->createToken(time())->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user],200);
        } else {
            return response()->json(['message' => 'Credentials provided do not match with our records', 'status' => 401],401);
        }
    }


    public function logout(Request $request)
    {
          // delete all tokens, essentially logging the user out
       $done= $request->user()->tokens()->delete();
       // delete the current token that was used for the request
      $dome= $request->user()->currentAccessToken()->delete();

      if ($done && $dome) {
       return response()->json([
           "message"=>"logged out "
       ],200);
      }
        // //resignation  of the token
        // // Set public.oauth_access_tokens.revoked to true
        // //revoking the user token
        // $request->user()->token()->revoke();
        // //deleting the user token
        // $request->user()->token()->delete();
        // // Revoke all of the token's refresh tokens
        // // => Set public.oauth_refresh_tokens.revoked to TRUE (t)
        // $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');
        // $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($request->user()->token()->id);
        // return response()->json(['message' => 'Logged out successfully', 'status' => 200]);
    }
}
