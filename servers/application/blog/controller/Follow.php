<?php


namespace app\blog\controller;


use app\common\controller\BaseController;
use app\blog\model\Follow as FollowModel;
use app\lib\Response;
use app\admin\service\User;
use app\admin\model\User as UserModel;
use app\lib\exception\ResourcesException;
class Follow extends BaseController
{
    public function addwatch($user_id,$followed_userid){
        $check = FollowModel::where('user_id', $user_id)->where('followed_user', $followed_userid)->count();

        if($check>0){
            throw new ResourcesException(['msg'=>'已关注过此作者']);
        }
        else{
        $newfollow = FollowModel::create([
            'user_id' =>$user_id,
            'followed_user' => $followed_userid
        ]);
    }
        return new Response();
    }
    public function getfollowList($id) {
        //$user = User::init();
        //$user = UserModel::get($id);
        $follower=FollowModel::get(['user_id'=>$id]);

        $condition = [
            'user_id' => $follower['followed_user']
            //'status' => 1
        ];
        $field = 'user_name';
        $list = UserModel::getfollowList($condition,$field);
        return new Response(['data'=>$list]);
    }
}