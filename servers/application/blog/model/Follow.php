<?php
/**
 * Created by bianquan
 * User: ZhuYunlong
 * Email: 920200256@qq.com
 * Date: 2019/2/17
 * Time: 17:45
 */

namespace app\blog\model;


use app\common\model\BaseModel;

class Follow extends BaseModel
{

    public static function getTitleList($condition,$field) {
        return self::where($condition)->field($field)->order('i_id desc')->select();
    }
}

