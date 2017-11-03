<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/10/25/0025
 * Time: 14:43
 */
namespace app\validate;
class VersionVailate extends BaseVailate
{
    protected $rule=[
        'app_type'=>'require',
        'version'=>'require|IdMustPositive',
        'version_code'=>'require',
        'upgrade_point'=>'require',
        'apk_url'=>'require',
        'is_force'=>'in:0,1',
    ];
    protected $message=[
        'app_type.require'=>"平台类型必须选择",
        'version.require'=>"内部版本号必须填写",
        'version.IdMustPositive'=>"内部版本号必须是数字",
        'version_code.require'=>"外部版本号必须填写",
        'upgrade_point.require'=>"更新内容必须填写",
        'apk_url.require'=>"下载地址必须填写",
        'is_allowcomments.in'=>'是否强制更新状态不正确',
    ];
}