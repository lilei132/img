<?php
/**
 * Created by bianquan
 * CommonUser: ZhuYunlong
 * Email: 920200256@qq.com
 * Date: 2019/1/19
 * Time: 20:29
 */

namespace app\blog\controller;
use app\admin\service\Images;
use app\admin\service\User;
use app\admin\model\User as UserModel;
use app\admin\model\ImagesSource;
use app\blog\service\Img as ImgService;
use app\common\controller\BaseController;
use app\common\validate\PagingParameter;;
use app\blog\model\Imgupload as ImgModel;
use app\lib\exception\AuthException;
use app\lib\exception\ResourcesException;
use app\lib\Response;

class Imgupload extends BaseController
{
    public function addImg($a_title,$outline='',$a_content,$a_img=0,$tag_id,$imgs=[],$id) {
        //$user = User::init();
        $user = UserModel::get($id);
        $Imgupload = ImgModel::create([
            'i_title' =>$a_title,
            'i_content' =>$a_content,
            'outline' => $outline,
            'i_img' => $a_img,
            'tag_id' => $tag_id,
            'user_id' =>$user['user_id']
        ]);
        if(!$Imgupload) {
            throw new ResourcesException();
        }
        Images::addImages($imgs,$Imgupload->i_id,'Imgupload',$id);
        return new Response();
    }

    public function getimgTitleList($id) {
        //$user = User::init();
        $user = UserModel::get($id);
        $condition = [
            'user_id' => $user['user_id']
            //'status' => 1
        ];
        $field = 'i_id,i_title,i_img,published,create_time';
        $list = ImgModel::getTitleList($condition,$field);
        return new Response(['data'=>$list]);
    }

    public function getList($tagID,$userID,$page,$limit)
    {
        (new PagingParameter())->goCheck();
        $list = ImgService::getList($tagID,$userID,$page,$limit);
        return new Response(['data'=>$list]);
    }
    
    public function getOne($ID) {
        $article = ImgModel::getOne(['i_id'=>$ID]);
        if($article) {
            $articleImages = ImagesSource::all(['table_name'=>'Imgupload','table_id'=>$ID],'image');
            $images = [];
            foreach ($articleImages as $articleImage) {
                $images[] = $articleImage['image'];
            }
            $article->images = $images;
            return new Response(['data'=>$article]);
        } else {
            throw new ResourcesException(['msg'=>'找不到对应图片']);
        }
    }

    public function getTitleListByPage($title,$author,$tag,$page,$limit,$sort='create_time',$order='desc') {
        $list = ImgService::getTitleList($title,$author,$tag,$page,$limit,$sort,$order);
        return new Response(['data'=>$list]);
    }
    public function addimgPraise($id) {
        if($id !=0) {
            $img = ImgModel::get($id);
            $img->setInc('praise_num');
        }
        return new Response();
    }
    public function del($id) {
        $img = ImgModel::get($id);
        if(empty($img)) {
            throw new ResourcesException();
        }
        // $user = User::init();
        // if($article->user_id != $user['user_id']) {
        //     throw new AuthException();
        // }
        $img->delete();
        return new Response();
    }
    public function addpageview($id) {
        
        $article = ImgModel::get($id);
        $article->setInc('viewer_num');
        
        return new Response();
    }







}