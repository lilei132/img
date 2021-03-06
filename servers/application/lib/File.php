<?php
/**
 * Created by bianquan
 * User: ZhuYunlong
 * Email: 920200256@qq.com
 * Date: 2019/2/16
 * Time: 9:06
 */

namespace app\lib;

/**
 * 上传类
 * Class File
 * @package app\lib
 */
class File
{
    protected static $file = null;

    public static function inti($file) {
        if(!self::$file) {
            self::$file = self::getRootUpload($file);
        }
    }

    /**
     * 获取上传的网站路劲
     * @param $file
     * @return string
     */
    public static function getHttpPath($file) {
        return UPLOAD_SITE_URL.DS.$file;
    }


    /**
     * 获取上传的绝对目录
     * @param $file
     * @return string
     */
    public static function getRootUpload($file) {
        return ROOT_PATH.'public'.DS.'uploads'.DS.$file;
    }


    /**
     * [将Base64图片转换为本地图片并保存]
     */
    public static function saveBase64($base64, $file){
        self::inti($file);
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)){
            $type = $result[2];
            if(!file_exists(self::$file)){
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                self::directory(self::$file);
            }
            $fileName = time().getRandChar(5).".{$type}";
            $new_file = self::$file.DS.$fileName;
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64)))){
                return $fileName;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /*
     * 递归创建路劲文件夹
     */
    public static function directory( $dir ){
        return  is_dir ( $dir ) or self::directory(dirname( $dir )) and  mkdir ( $dir , 0777);
    }


    /*
     * 常规上传图片公共处理
     */
    public static function uploadPicture($upload_path,$file_name,$save_name='')
    {
        $file_object = request()->file($file_name);
        if(!$file_object) {
            return false;
        }
        $upload_path = BASE_UPLOAD_PATH . DS . $upload_path;
        if($save_name){
            $info = $file_object->validate(['ext' => ALLOW_IMG_EXT])->move($upload_path, $save_name);
        }else{
            $info = $file_object->rule('uniqid')->validate(['ext' => ALLOW_IMG_EXT])->move($upload_path);
        }
        if ($info) {
            $imageUrl = $info->getSaveName();
            return $imageUrl;
        }else{
            return false;
        }
    }

    /*
    * 删除图片
    */
    public static function unlink($fileName,$path) {
        $path = self::getRootUpload($path);
        new WriteLog($fileName.'---'.$path);
        @unlink( $path.$fileName);
    }

    /**
     *移动图片/文件
     */
    public static function moveFile($from, $to,$fileName) {
        $from = self::getRootUpload($from).$fileName;
        $to = self::getRootUpload($to);
        if (!file_exists($from)) {
            return false;
        }
        if (file_exists($to.$fileName)) {
            return false;
        } else {
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            self::directory($to);
        }
        dump($from);
        dump($to);
        return rename($from, $to.$fileName);
    }
}