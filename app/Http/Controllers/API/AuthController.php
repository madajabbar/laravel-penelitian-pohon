<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8'
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error($validator->errors());
            }

            $user = User::where('email', $request->email)->first();
            $this->check($user,$request);

            $token = $user->createToken('auth_token')->plainTextToken;

            return ResponseFormatter::success(
                [
                    'user' => $user,
                    'token_type' => 'Bearer',
                    'access_token' => $token
                ]
            );
        }
        catch(Exception $e){
            return ResponseFormatter::error([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 'User Unregistered', 500);
        }

    }

    public function logout(Request $request){
        try {
            $request->user()->tokens()->delete();
            return ResponseFormatter::success([
                'message' => 'Successfully logged out'
            ]);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'User Unregistered', 500);
        }
    }
    public function check($user,$request){
        if($user == null){
            return ResponseFormatter::error('User Not Found');
        }
        if (!Hash::check($request->password,$user->password)) {
            return ResponseFormatter::error(
                'Invalid password'
            );
        }
    }
}
