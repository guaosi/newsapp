<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/10/14/0014
 * Time: 13:09
 */
namespace app\validate;
class AdminUserLogin extends BaseVailate
{
    protected $rule=[
        'username'=>'require|max:20',
        'password'=>'require|max:16'
    ];
    protected $message=[
        'username.require'=>'用户名不能为空',
        'username.max'=>'用户名不能超过20',
        'password.require'=>'密码不能为空',
        'password.max'=>'密码不能超过20',
    ];
}