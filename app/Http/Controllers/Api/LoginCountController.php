<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\loginCount;
use App\Models\User;
use Illuminate\Http\Request;

class LoginCountController extends BaseController
{
    /**
     * 添加登陆天数
     */
    public function store(loginCount $loginCount,User $user)
    {
        $user_id = auth('api')->id();
        $checkUser = $loginCount->where('user_id',$user_id)->first();
        $checkNum = $loginCount
            ->where('user_id',$user_id)
            ->where('updated_at','<',date('Y-m-d 0:0:0',time()))
            ->get();

        if (!empty($checkUser)){
            if (count($checkNum) == 1) {
                $loginCount->count = loginCount::where('user_id',$user_id)->increment('count',1);
                return $this->response->noContent();
            }
            return $this->response->noContent();
        }
        $loginCount->user_id = $user_id;
        $loginCount->count = 1;
        $loginCount->save();
        return $this->response->created();
    }

    /**
     * 查询登陆天数
     */
    public function index()
    {
        $user_id = auth('api')->id();
        $count = loginCount::where('user_id',$user_id)->get();
        return $count;
    }
}
