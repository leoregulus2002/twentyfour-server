<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Integration;
use App\Models\IntegrationDetails;
use App\Transformers\IntegrationTransformer;
use Illuminate\Http\Request;

class IntegrationController extends BaseController
{
    /**
     * 积分列表
     */
    public function index(Request $request) {
        $user_id = $request->input('user_id');
        $integration = Integration::when($user_id,function ($query) use ($user_id) {
            $query->where('user_id',$user_id);
        })->paginate(7);

        return $this->response->paginator($integration,new IntegrationTransformer());
    }

    public function show(Integration $integration) {
        return $this->response->item($integration,new IntegrationTransformer());
    }



}
