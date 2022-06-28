<?php

$api = app('Dingo\Api\Routing\Router');
$middleware = ['middleware' => ['api.throttle','bindings'], 'limit' => 60, 'expires' => 1];

$api->version('v1',$middleware, function ($api) {

    // 路由组
    $api->group(['prefix'=>'auth'],function ($api) {
        // 注册
        $api->post('register',[\App\Http\Controllers\Auth\RegisterController::class,'store']);
        $api->get('getSession',[\App\Http\Controllers\Auth\RegisterController::class,'getSession']);
        $api->post('login',[\App\Http\Controllers\Auth\LoginController::class,'login']);
        $api->get('test',[\App\Http\Controllers\test::class,'store']);


        //需要登录的路由
        $api->group(['middleware' => 'api.auth'],function ($api) {

        });
    });

});
