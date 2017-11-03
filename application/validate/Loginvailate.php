<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/11/1/0001
 * Time: 17:31
 */
namespace app\validate;
class Loginvailate extends BaseVailate
{
    protected $rule=[
        'phone'=>'require|isMobile',
        'code'=>'number|length:4',
        'password'=>'max:20'
    ];
    protected $message=[
        'phone.require'=>'手机号必须填写',
        'phone.isMobile'=>'手机号格式不正确',
        'code'=>'验证码格式不正确',
        'password'=>'密码格式不正确'
    ];
}