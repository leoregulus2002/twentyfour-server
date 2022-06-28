<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends BaseController
{
    /**
     * 登陆
     */
    public function login(Request $request)
    {
        $user = User::where('openID', $request->input('openID'))->first();
        if($request->input('session_key') == $user->session_key){
            $token = JWTAuth::fromUser($user);
        }

        return $this->respondWithToken($token);
    }

    /**
     * 刷新token
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * 格式化返回
     */
    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
