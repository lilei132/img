<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/1/9
 * Time: 20:01
 */

namespace app\adminApi\service;



use app\lib\exception\TokenException;

class UserToken extends Token
{
    private function saveToCache()
    {
        $key = self::generateToken('1','123@.qq.com','www');
        $expire_in = config('token.exp');
        $result = cache($key, '', $expire_in);
        if (!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }
}