<?php


namespace app\blog\controller;

use app\blog\model\User as Usermodel;
use app\common\controller\BaseController;
use app\lib\exception\ResourcesException;
use app\lib\Response;

class Usercenter extends BaseController
{
    public function getList($userID=1) {
        $neighbors = NeighborsModel::all(['user_id'=>$userID]);
        return new Response(['data'=>$neighbors]);
    }

    public function getAll() {
        $neighbors = NeighborsModel::all();
        return new Response(['data'=>$neighbors]);
    }

    public function add($nb_name,$nb_url,$nb_icon,$nb_published,$user_id) {
        $result = NeighborsModel::create([
            'nb_name' =>$nb_name,
            'nb_url' => $nb_url,
            'nb_icon' => $nb_icon,
            'nb_published' => $nb_published,
            'user_id' => $user_id
        ]);
        return new Response(['data'=>$result]);
    }

    public function update($user_id,$user_name) {
        $user = Usermodel::get($uer_id);
        if (empty($user)) {
            throw new ResourcesException();
        }
        $user->user_name = $nb_name;
        $user->save();
        return new Response(['data'=>$user]);
    }

    public function del($id) {
        $neighbor = NeighborsModel::get($id);
        if (empty($neighbor)) {
            throw new ResourcesException();
        }
        $neighbor->delete();
        return new Response();
    }
    public function addwatch($userid,$articleid){
        $user = Usermodel::get($user_id);
        if (empty($user)) {
            throw new ResourcesException();
        }
    }
    public function getfollowList($userid,$articleid){
        $user = Usermodel::get($uer_id);
        if (empty($user)) {
            throw new ResourcesException();
        }
    }

}