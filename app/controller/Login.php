<?php

namespace app\controller;

use app\BaseController;
use app\model\User;
use app\validate\UserValidate;

use think\captcha\facade\Captcha;
use think\Request;

class Login extends BaseController{

    //注册
    public function  register(Request $request){

        if($request->isPost()){
            $post = $request->post();
            $data = [
                'username'  => $post['username'],
                'password'  =>   $post['password'],
                're_password'  =>  $post['re_password'],
                'captcha'   =>  $post['captcha']
            ];

            $uv = new UserValidate();
            if(!$uv->scene('register')->check($data)){
                return ['code'=>1,'msg'=>$uv->getError()];
            }
           $u = new User();
            $data['password'] = MD5($data['password']);
            if($u->addData($data)){
                return ['code'=>0,'msg'=>'注册成功'];
            }else{
                return ['code'=>1,'msg'=>'注册失败'];

            }
        }else{
            return ['code'=>1,'msg'=>'接口不存在'];
        }
    }

    //登录
    public function login(Request $request){
        if($request->isPost()){
            $post = $request->post();
            $data = [
                'username'  => $post['username'],
                'password'  =>  $post['password'],
                'captcha'   =>  $post['captcha']
            ];
            $uv = new UserValidate();

            if(!$uv->scene('login')->check($data)){
                return ['code'=>1,'msg'=>$uv->getError()];
            }

            unset($data['captcha']);

            $data['password'] = MD5($data['password']);
            $u = new User();
            $res = $u->field('id,username')->where($data)->find();

            if(!empty($res)){
                $returnData = [
                    'token' =>  createToken(),
                    'id'    =>$res['id'],
                    'username'  =>  $res['username']
                ];
                return ['code'=>0,'returnData'=>$returnData,'msg'=>'登录成功'];
            }else{
                return ['code'=>1,'msg'=>'登录失败'];
            }

        }else{
            return ['code'=>1,'msg'=>'接口不存在'];
        }
    }
    //验证码
    public function verify(){

        return Captcha::create('only_nums');
    }

    //验证信息是否正确
    public function validateLogin(Request $request){
        if($request->isPost()) {
            $post = $request->post();
            if(validateToken($post['token'])){
                return ['code'=>0,'msg'=>'验证成功'];
            }else{
                return ['code'=>1,'msg'=>'验证失败'];
            }
        }else{
            return ['code'=>1,'msg'=>'接口不存在'];
        }
    }
}