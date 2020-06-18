<?php


namespace app\blog\controller;


use app\common\controller\BaseController;
use app\blog\model\Follow as FollowModel;
use app\lib\Response;
use app\admin\service\User;
use app\admin\model\User as UserModel;

class Follow extends BaseController
{
    public function addwatch($user_id,$followed_userid){
        $newfollow = FollowModel::create([
            'user_id' =>$user_id,
            'followed_user' => $followed_userid
        ]);
        return new Response();
    }
    public function getauthor($id2){
    	$user = UserModel::get($id2);

        return new Response(['data'=>$user]);
    }
}