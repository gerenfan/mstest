<?php

namespace app\middleware;

use think\facade\Request;

class Auth
{
    public function handle( $request, \Closure $next)
    {
        $r = new Request();
        $id = $request->post('id');
        $token = $request->post('token');
        if(isset($token) && !empty($token)){
            if(!validateToken($token)){
                return json(['code'=>1,'msg'=>'请登录!']);
            }
        }else{
            return json(['code'=>1,'msg'=>'请登录!']);
        }
        if (!isset($id) || empty($id)) {
            return json(['code'=>1,'msg'=>'请登录!']);

        }else{
            $auth = new \auth\Auth();
            $res = $auth->check($r::controller().'/'.$r::action(),$id);

            if(!$res){
                return json(['code'=>1,'msg'=>'您不是该权限下用户!']);
            }
        }

        return $next($request);
    }
}