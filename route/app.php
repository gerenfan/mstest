<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;


Route::get('verify', 'login/verify');
Route::post('register','login/register')
    ->allowCrossDomain();
Route::post('login','login/login')
    ->allowCrossDomain();
Route::post('validateLogin', 'login/validateLogin') ->allowCrossDomain();
Route::post('number', 'user/number')->allowCrossDomain();
Route::post('general', 'user/general')->allowCrossDomain();