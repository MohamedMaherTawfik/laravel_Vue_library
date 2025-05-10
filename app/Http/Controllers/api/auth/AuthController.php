<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use apiResponse;

    public function register(userRequest $request)
    {
        $fields = $request->validated();
        $user = $fields;
        $user['password'] = bcrypt($user['password']);
        $user = User::create([
            'username' => $user['username'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'phone' => $user['phone'],
        ]);
        if (!$user) {
            return $this->sendError('Register Failed');
        }
        return $this->apiResponse($user, 'Register Successfully');
    }

    public function login()
    {
        $token=Auth::attempt(request(['email', 'password']));
        if (!$token) {
            return $this->sendError('Login Failed', );
        }
        $success = $this->respondWithToken($token);

        return $this->apiResponse($success->original, 'Logined bro');
    }
    public function profile()
    {
        $user=User::find(Auth::user()->id);
        if(!$user){
            return $this->sendError('User Not Found');
        }
        return $this->apiResponse($user, 'Profile');
    }

    public function logout()
    {
        Auth::logout();

        return $this->apiResponse([], 'Logout Successfully');
    }

    public function refresh()
    {
        $token = $this->respondWithToken(Auth::refresh());
        return $this->apiResponse($token->original, 'Refresh Successfully');
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}