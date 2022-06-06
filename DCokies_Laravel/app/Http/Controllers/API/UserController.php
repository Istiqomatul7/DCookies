<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'password'],
            'password' => ['required']
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return $this->sendError('Unauthorized','Authentication failed', 500);
        }

        $user = User::where('email', $request->email)->first();
        if(!Hash::check($request->password, $user->password, [])){
            throw new \Exception('Invalid Credentials');
        }

        //jika berhasil login
        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return $this->sendResponse([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user
        ], 'Authenticated');


    }


    public function store(Request $request){ //register

        try{
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                'password' => ['required', 'min:6']
            ]);
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]); //insert data
    
            $user = User::where('email', $request->email)->first();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
    
            $data = [
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ];
    
            return $this->sendResponse($data, 'Succesfull Register');
        }catch(Exception $error){
            return $this->sendError(
                [
                    'message' => 'Something went wrong',
                    'error' => $error
                ],
                'Registration Failed',
            );

        }

    }

    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->tokens()->delete();
        return response()->noContent();
    }
    
}

