<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Annotations\AuthentificationAnnotationController;
use App\Http\Controllers\Controller;
use App\Models\AbstractModels\SwooleCacheTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use SwooleCacheTrait;
    public function __construct()
    {
        /**
         * @var AuthentificationAnnotationController
         * @return JsonResponse
         */
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(["message" => "User successfully created", "User" => $user], 201);
    }
    public function login(Request $request)
    {
        $credentials = $request->only(
            'email',
            'password'
        );
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'invalid credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function update(Request $request, User $user): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'password' => 'confirmed|min:8',
        ]);
        if ($validator->fails()) {
            return  response()->json([
                "success" => false,
                "errors" => $validator->errors()->toJson()

            ], 422);
        }
        $user->update($request->all());
        SwooleCacheTrait::forgetSwoole('users');
        return response()->json([
            "message" => "User updated",
            "User" => $user
        ], 200)->responseHeader($request);
    }

    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => env('JWT_TTL') * 60 . "s"
        ]);
    }
}
