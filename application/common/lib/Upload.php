<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/10/15/0015
 * Time: 17:31
 */

namespace app\common\lib;

// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

class Upload
{
    public static function deleteByQiniu($key='')
    {
        $accessKey = config('qiniu.accessKey');
        $secretKey = config('qiniu.secretKey');
        $bucket = config('qiniu.bucket');
        $auth = new Auth($accessKey, $secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $bucketManager->delete($bucket, $key);
    }
    public static function UploadByQiniu()
    {
        // 要上传文件的本地路径
        $fileName=$_FILES['file']['tmp_name'];

        if(empty($fileName))
        {
           exception('图片上传失败，请重试',404);
        }
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = config('qiniu.accessKey');
        $secretKey = config('qiniu.secretKey');
        $bucket = config('qiniu.bucket');
// 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
// 生成上传 Token
        $token = $auth->uploadToken($bucket);
// 上传到七牛后保存的文件名
        $key = date('Y').'-'.date('m').'-'.date('d').'-'.uniqid().'-'.$_FILES['file']['name'];
// 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
// 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $fileName);
        if ($err !== null) {
            return false;
        } else {
//            上传成功
            return $ret['key'];
        }
    }
}
