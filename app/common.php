<?php
// 应用公共文件


//生成token
function createToken():string {
    $time = time();

   $token = (new \Lcobucci\JWT\Builder())->issuedBy('http://localhost:8000') //接口地址
    ->permittedFor('http://localhost:8090')//请求地址
    ->identifiedBy('4f1g23a12aa', true)
    ->issuedAt($time)
    ->expiresAt($time + 3600)
    ->withClaim('uid', 1)
    ->getToken();
    return (string)$token;
}

//验证token
function validateToken(string $token):bool{
    if(!is_string($token)){
        return false;
    }
    $data = explode('.', $token);
    if (count($data) != 3) {
       return false;
    }
    try {
        $data = new \Lcobucci\JWT\ValidationData();
        $tokenValidate = (new \Lcobucci\JWT\Parser())->parse((string) $token);
        $res = $tokenValidate->validate($data);
        return $res;
    } catch (\think\Exception $e) {
        return false;
    }


}