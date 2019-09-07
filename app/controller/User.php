<?php

namespace app\controller;

use app\BaseController;

class User extends BaseController{
    protected $middleware = ['app\middleware\auth'];
    public function number()
    {
        return json(['code'=>0,'msg'=>'您是会员用户']);
    }

    public function general()
    {
        return json(['code'=>0,'msg'=>'您是普通用户']);

    }
}