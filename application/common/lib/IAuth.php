<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/10/14/0014
 * Time: 15:02
 */
namespace app\common\lib;
class IAuth
{
    public static function haltPassword($data)
    {
        return md5($data.config('setting.PASS_SALT'));
    }

    /**
     * 用于返回Aes加密后的数据
     * @param array $data
     */
    public static function setSign($data=[])
    {
//         1.将数组按字段排序
          ksort($data);
//          2.将数组转为&拼接
          $str=http_build_query($data);
//          3.Aes加密返回
          $aesStr=(new Aes())->encrypt($str);
          return $aesStr;
    }

    /**
     * 验证sign是否合法
     * @param array $data  //header信息
     * @return bool
     */
    public static function checkSign($data=[])
    {
//       1. 将sign先解密
       $signData=(new Aes())->decrypt($data['sign']);
       if(empty($signData))
       {
           return false;
       }
//       2.将sign变成数组形式,放入$arr;
       parse_str($signData,$arr);
//       3.验证数组是否与header中的数据相同
        if (empty($arr)||empty($arr['did'])||$data['did']!=$arr['did'])
        {
            return false;
        }
        if(!config('app_debug'))
        {
//            如果是开发模式，就不去验证时间了
            //       4.验证时间差
            if(time()-ceil($arr['time']/1000)>config('setting.app_sign_time'))
            {
                return false;
            }
//        5.验证缓存是否存在，以此来验证唯一性
            if(cache($data['sign']))
            {
                return false;
            }
        }

        return true;
    }
    public static function setUserToken($phone='')
    {
         $str=md5(uniqid(md5(microtime(true)),true));
         return sha1($str.$phone);
    }
}