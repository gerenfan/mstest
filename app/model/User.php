<?php

namespace app\model;

use think\Model;

class User extends Model{

    //插入数据
    public function addData(array $data,bool $add_time=true): bool {
        if($add_time){
            $data['add_time'] = date('Y-m-d H:i:s',time());
        }
        if($this->save($data)){
            return true;
        }else{
            return false;
        }
    }


}