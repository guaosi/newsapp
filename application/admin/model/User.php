<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/11/1/0001
 * Time: 23:09
 */
namespace app\admin\model;
use think\Model;
class User extends Model
{
    protected $insert = ['status' => 1];
    protected $autoWriteTimestamp = true;
    public static function getUserInfoByIds($ids=[])
    {
        $ids=[2,3];
         $id=implode(',',$ids);
         $where=[
             'id'=>['in',$id]
         ];
         return self::field(['id','username','image'])->where($where)->order('id','desc')->select();
    }
    /**
     * 会员分页
     * @param array $param
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getUsersByCondition($where=[],$nowNuber=1,$size=5)
    {
        $order=['id'=>'desc','create_time'=>'desc'];
        return self::where($where)->limit($nowNuber,$size)->order($order)->select();
    }

    /**
     * 获取分页条数总数
     * @param array $param
     * @return int|string
     */
    public static function getUsersByConditionCount($where=[])
    {
        return self::where($where)->count();
    }
}