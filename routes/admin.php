<?php

$api = app('Dingo\Api\Routing\Router');
$middleware = ['middleware' => ['api.throttle','bindings'], 'limit' => 60, 'expires' => 1];

$api->version('v1',$middleware, function ($api) {

    // 路由组
    $api->group(['prefix'=>'admin'],function ($api) {

        //需要登录的路由
        $api->group(['middleware' => 'api.auth'],function ($api) {
            $api->get('integrations',[\App\Http\Controllers\Admin\IntegrationController::class,'index']);
            $api->get('integrations/{integration}',[\App\Http\Controllers\Admin\IntegrationController::class,'show']);
        });
    });

});
