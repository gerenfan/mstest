<?php
/**
 * Created by PhpStorm.
 * User: 47125
 * Date: 2019-09-05
 * Time: 13:01
 */
return [
    'only_nums'=>[
        'codeSet'=>'1234567890',
        //设置验证码大小
        'fontSize' => 18,
        //添加混淆曲线
        'useCurve' => false,
        //设置图片的高度、宽度
        'imageW' => 150,
        'imageH' => 35,
        //验证码位数
        'length' =>4,
        //验证成功后重置
        'reset' =>true
    ]
];