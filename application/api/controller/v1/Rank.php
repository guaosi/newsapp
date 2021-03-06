<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/10/30/0030
 * Time: 17:09
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use app\admin\model\News as NewsModel;
class Rank extends Common
{
    /**
     * 用于返回排行榜的接口 按照阅读数排序
     * @return array
     */
    public function index()
    {
         $news=NewsModel::getRankListNews();
         $news=$this->showCatNameById($news->toArray());
         return showJson(config('admin.app_success'),'OK',$news);
    }
}