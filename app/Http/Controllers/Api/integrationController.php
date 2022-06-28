<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Integration;
use App\Models\IntegrationDetails;
use App\Transformers\IntegrationDetailsTransformer;

class integrationController extends BaseController
{
    /**
     * 添加积分
     */
    public function store(Integration $integration,IntegrationDetails $integrationDetails)
    {

        $user_id = auth('api')->id();
        $checkUserId = $integration->where('user_id',$user_id)->first();
        $checkNum = $integrationDetails
            ->where('user_id',$user_id)
            ->where('created_at','>',date('Y-m-d 0:0:0',time()))
            ->where('created_at','<',date('Y-m-d 0:0:0',time()+24*60*60))
            ->get();
        if (count($checkNum) == 5){
            return $this->response->noContent();
        }
        $integrationDetails->user_id = $user_id;
        $integrationDetails->price = 2;
        $integrationDetails->save();
        if (empty($checkUserId)) {
            $integration->user_id = $user_id;
            $integration->amount = 2;
            $integration->save();
            return $this->response->created();
        }
        $integration->amount = Integration::where('user_id',$user_id)->increment('amount',2);
        return $this->response->created();
    }

    /**
     * 积分列表
     */
    public function index() {
        $user_id = auth('api')->id();
        $integration = IntegrationDetails::where('user_id',$user_id)->paginate(9);
        return $this->response->paginator($integration,new IntegrationDetailsTransformer());
    }

}
