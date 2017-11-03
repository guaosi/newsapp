<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/10/25/0025
 * Time: 14:43
 */
namespace app\validate;
class PushVailate extends BaseVailate
{
    protected $rule=[
        'type'=>'require',
        'title'=>'require|max:50',
        'news_id'=>'require|IdMustPositive',
    ];
    protected $message=[
        'type.require'=>"推送必须选择",
        'news_id.require'=>"新闻ID必须填写",
        'news_id.IdMustPositive'=>"新闻ID必须是数字",
        'title.require'=>"推送标题必须填写",
        'title.max'=>"推送标题过长",
    ];
}