<?php


namespace app\admin\controller;


use app\admin\model\User as UserModel;
use app\admin\service\User as UserService;
use app\admin\model\Admin as AdminModel;
use app\common\validate\PagingParameter;
use app\lib\exception\ParameterException;
use app\lib\exception\RepeatException;
use app\lib\exception\ResourcesException;
use app\lib\Response;
use app\lib\exception\LoginException;
class User extends BaseController
{
    /**
     * @Api(通过邮箱登录,1,POST)
     */
    public function login($email,$password) {
        $userData = UserService::loginByEmail($email,$password);
        return new Response(['data'=>$userData]);
    }

    /**
     * @Api(用户注册,1,POST)
     */
    public function register($name,$email,$password,$radio) {
        $result = UserService::register($name,$email,$password,$radio);
        return new Response(['msg'=>'注册成功','data'=>$result]);
    }

    /**
     * @Api(获取用户列表,3,GET)
     */
    public function getList() {
        (new PagingParameter())->goCheck();
        $condition = [];
        $userName = input('username');
        $userMobile = input('mobile');
        if(!empty($userName)) $condition['user_name'] = ['like',"%$userName%"];
        if(!empty($userMobile)) $condition['user_mobile'] = ['like',"%$userMobile%"];
        $order = ['user_id'=>'desc'];
        $page = input('page');
        $limit = input('limit');
        $list = UserModel::getListByPage($condition,$order,$page, $limit);
        return new Response(['data'=>$list]);
    }

    /**
     * @Api(根据条件获取一名用户信息,3,GET)
     */
    public function getOne($type,$value) {
        switch ($type) {
            case 'user_name':
            case 'user_email':
                $user = UserModel::get([$type=>$value]);
                if(empty($user)) {
                    throw new ResourcesException(['msg'=>'用户不存在']);
                }
                if(AdminModel::get(['user_id'=>$user->user_id])) {
                    throw new RepeatException(['msg'=>'该用户已经是管理员，请不要重复添加']);
                }
                return new Response(['data'=>$user]);
                break;
            default:
                throw new ParameterException(['msg'=>'type类型错误！']);
        }
    }

    /**
     * @Api(修改用户状态,3,POST)
     */
    public function changeStatus($id,$status) {
        $user = UserModel::get($id);
        if(empty($user)) {
            throw new ResourcesException();
        }
        $user->user_status = $status;
        $user->save();
        return new Response();
    }
    /**
     * @Api(修改用户名字,4,POST)
     */

    public function changeName($id,$name) {
        $user = UserModel::get($id);
        if(empty($user)) {
            throw new ResourcesException();
        }
        $user->user_name = $name;
        $user->save();
        return new Response();
    }


    public function changeDetail($id,$address,$gender) {
        $user = UserModel::get($id);
        if(empty($user)) {
            throw new ResourcesException();
        }
        $user->user_address = $address;
        $user->gender = $gender;
        $user->save();
        return new Response();
    }
    public function changePassword($id,$password,$newpassword) {
        $user = UserModel::get($id);
        if(!UserService::checkPassword($user,$password)) {
            throw new LoginException(['msg'=>'密码错误','errorCode'=>10002]);
        } 
        $passwordSalt = getRandChar(32);
        $password2 = UserService::generatePassword($newpassword,$passwordSalt);
        $user->user_pwd = $password2;
        $user->user_pwd_salt =$passwordSalt;
        $user->save();
        return new Response();
    }
    public function updateavatar($id,$user_avatar) {
        $user = usermodel::get($id);
        if(empty($avator)) {
            throw new ResourcesException();
        }
        $user->user_avatar = $user_avatar;
        $user->save();
        return new Response();
    }
        public function changeName2($id,$user_avatar) {
        $user = UserModel::get($id);
        if(empty($user)) {
            throw new ResourcesException();
        }
        $user->user_avatar = $user_avatar;
        $user->save();
        return new Response(['data'=>$user->user_avatar]);
    }
        public function getOneavatar($id) {

            $user = UserModel::get($id);
            return new Response(['data'=>$user]);

        }
    
    


}