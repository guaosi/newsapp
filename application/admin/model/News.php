<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/10/16/0016
 * Time: 0:07
 */
namespace app\admin\model;
use think\Model;
class News extends Model
{
    protected $insert = ['status' => 1];
    protected $autoWriteTimestamp = true;
//    public function getStatusAttr($value)
//    {
//        $status = [0=>'待审核',1=>'正常'];
//        return $status[$value];
//    }

//    public function getCatidAttr($value)
//    {

//    }

    /**
     * tp5自带获取分页
     * @param int $page
     * @return \think\Paginator
     */
    public static function getNewsPage($page=10)
    {
        $where['status']=[
            'neq',('admin.status_delete')
        ];
        $order=['id'=>'desc'];
        return self::where($where)->order($order)->paginate($page);
    }

    /**
     * 原生分页写法
     * @param array $param
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getNewsByCondition($where=[],$nowNuber=1,$size=5)
    {
        $order=['id'=>'desc','create_time'=>'desc'];
        return self::where($where)->limit($nowNuber,$size)->order($order)->select();
    }

    /**
     * 获取分页条数总数
     * @param array $param
     * @return int|string
     */
    public static function getNewsByConditionCount($where=[])
    {
        return self::where($where)->count();
    }

    /**
     * 获取首页头图信息
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     */
   public static function getIndexHeadNews($num=3)
   {
        $where=[
            'status'=>1,
            'is_head_figure'=>1
        ];
        $order=[
            'id'=>'desc'
        ];
        return self::field(self::getFieldData())->where($where)->order($order)->limit($num)->select();
   }

    /**
     * 获取首页推荐位信息
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     */
   public static function getIndexPositionNews($num=10)
   {
       $where=[
           'status'=>1,
           'is_position'=>1
       ];
       $order=[
           'id'=>'desc'
       ];
       return self::field(self::getFieldData())->where($where)->order($order)->limit($num)->select();
   }
   private static function getFieldData()
   {
       return ['id','title','catid','image','read_count','create_time','status','is_position','update_time'];
   }
    /**
     * 获取排行榜信息
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getRankListNews($num=10)
    {
        $where=[
            'status'=>1,
        ];
        $order=[
            'read_count'=>'desc'
        ];
        return self::field(self::getFieldData())->where($where)->order($order)->limit($num)->select();
    }
}