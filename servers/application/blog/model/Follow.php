<?php
/**
 * Created by bianquan
 * User: ZhuYunlong
 * Email: 920200256@qq.com
 * Date: 2019/2/17
 * Time: 17:45
 */

namespace app\blog\model;

use think\Db;
use app\common\model\BaseModel;

class Follow extends BaseModel
{

    public static function getTitleList($condition,$field) {
        return self::where($condition)->field($field)->order('i_id desc')->select();
    }
    public static function getList($articleID) {
        return self::with(['reply.target'])->where(['article_id'=>$articleID,'father_id'=>0])->select();
    }
    public static function getFollowList($id) {
        return  Db::table('tv_follow')
                        ->alias('f')
                        ->where('tv_follow.user_id', $id)
                        ->join('user u','f.followed_user = u.user_id')
                        //->field($field)
                        ->select();
    }
}

