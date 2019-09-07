<?php

namespace app\validate;

use think\Validate;

class UserValidate extends Validate{

    protected $rule = [
        'username'  =>  'require',
        'password'  =>  'require',
        're_password'   =>  'require',
        'captcha|验证码'=>'require|captcha'
    ];
    protected $message = [
        'username.require'  =>  '用户名必须填写',
        'username.unique'  =>  '用户名已存在',
        'password.require'  =>  '密码必须填写',
        'password.confirm'  =>  '两次密码时输入不一致',
        're_password.require'   =>  '重复密码必须填写',
        'captcha.require'   =>  '请填写验证码',
        'captcha.captcha'   =>  '验证码验证错误'
    ];
    protected $scene = [
        'login'   =>  ['username','password','captcha'],

    ];
    // edit 验证场景定义
    public function register()
    {
        return $this->only(['username','password','re_password','captcha'])
            ->append('password','confirm')
            ->append('username','unique:user');

    }
}