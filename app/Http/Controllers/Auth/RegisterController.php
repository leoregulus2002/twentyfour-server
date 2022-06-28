<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Integration;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    //  注册
    public function store (Request $request,User $user) {
        $checkUser = $user->where('openID',$request->input('openID'))->first();
        if (!empty($checkUser)){
            $checkUser->update($request->all());
            $integration = Integration::where('user_id',$checkUser->id)->first();
            if (empty($integration)) {
                return [
                    "userInfo"=>$checkUser,
                    "integration"=> [
                        'amount'=> 0
                    ]
                ];
            }
            return [
                "userInfo"=>$checkUser,
                "integration"=>$integration
            ];
        }
        if ($request->input('status') === true ) {
            return $this->response->errorBadRequest();
        }
        $checkUser = $user->create($request->all());
        return [
            "userInfo"=>$checkUser,
            "integration"=> [
                'amount'=> 0
            ]
        ];
    }


    /**
     * 调用小程序auth.code2Session接口
     */
    public function getCode2Session($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function getSession (Request $request)
    {
        $js_code = $request->input('code');
        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        $appid = 'wx0b46afb154e41bc2';
        $secret = '75dfe0baf401c6cc1cb51abeb899f739';
        $grant_type = 'authorization_code';
        $session = $url . '?appid=' . $appid . '&secret=' . $secret . '&js_code=' . $js_code . '&grant_type=' . $grant_type;

        return $this->getCode2Session($session);

    }


}
