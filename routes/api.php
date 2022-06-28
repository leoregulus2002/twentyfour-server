<?php

$api = app('Dingo\Api\Routing\Router');
$middleware = ['middleware' => ['api.throttle','bindings'], 'limit' => 60, 'expires' => 1];

$api->version('v1',$middleware, function ($api) {

    // 路由组
    $api->group(['prefix'=>'api'],function ($api) {

        //需要登录的路由
        $api->group(['middleware' => 'api.auth'],function ($api) {
            /**
             * 幸运星
             */
            // 添加幸运星
            $api->post('integrations/add',[\App\Http\Controllers\Api\integrationController::class,'store']);
            // 幸运星列表
            $api->get('integrations',[\App\Http\Controllers\Api\integrationController::class,'index']);
            /**
             * 登陆天数
             */
            // 添加登陆天数
            $api->post('loginCount/add',[\App\Http\Controllers\Api\LoginCountController::class,'store']);
            // 查询登陆天数
            $api->get('loginCount',[\App\Http\Controllers\Api\LoginCountController::class,'index']);

        });
    });

});
