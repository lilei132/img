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
use app\blog\service\Article as ArticleService;
use app\common\controller\BaseController;
use app\common\validate\PagingParameter;
use app\blog\model\Article as ArticleModel;
use app\lib\exception\AuthException;
use app\lib\exception\ResourcesException;
use app\lib\Response;

class Article extends BaseController
{
    public function getList($tagID,$userID,$page,$limit)
    {
        (new PagingParameter())->goCheck();
        $list = ArticleService::getList($tagID,$userID,$page,$limit);
        return new Response(['data'=>$list]);
    }

    public function getOne($ID) {
        $article = ArticleModel::getOne(['a_id'=>$ID]);
        if($article) {
            $articleImages = ImagesSource::all(['table_name'=>'article','table_id'=>$ID],'image');
            $images = [];
            foreach ($articleImages as $articleImage) {
                $images[] = $articleImage['image'];
            }
            $article->images = $images;
            return new Response(['data'=>$article]);
        } else {
            throw new ResourcesException(['msg'=>'找不到对应文章']);
        }
    }

    public function getAllPublished() {
        $articles = ArticleModel::all(['published'=>1,'status'=>1]);
        if(empty($articles)) {
            throw new ResourcesException();
        }
        return new Response(['data'=>$articles]);
    }

    public function getTitleList($id) {
        //$user = User::init();
        $user = UserModel::get($id);
        $condition = [
            'user_id' => $user['user_id'],
            'status' => 0   
        ];
        $field = 'a_id,a_title,published,create_time';
        $list = ArticleModel::getTitleList($condition,$field);
        return new Response(['data'=>$list]);
    }

    public function getTitleListByPage($title,$author,$tag,$page,$limit,$sort='create_time',$order='desc') {
        $list = ArticleService::getTitleList($title,$author,$tag,$page,$limit,$sort,$order);
        return new Response(['data'=>$list]);
    }

    public function changeStatus($id,$status) {
        $article = ArticleModel::get($id);
        if(empty($article)) {
            throw new ResourcesException();
        }
        $article->status = $status;
        $article->save();
        return new Response();
    }

    public function changePublish($id) {
        $article = ArticleModel::get($id);
        if(empty($article)) {
            throw new ResourcesException();
        }
        $user = User::init();
        if($article->user_id != $user['user_id']) {
            throw new AuthException();
        }
        if($article->published) {
            $article->published = 0;
        } else {
            $article->published = 1;
        }
        $article->save();
        return new Response(['data'=>$article->published]);
    }

    public function del($id) {
        $article = ArticleModel::get($id);
        if(empty($article)) {
            throw new ResourcesException();
        }
        // $user = User::init();
        // if($article->user_id != $user['user_id']) {
        //     throw new AuthException();
        // }
        $article->delete();
        return new Response();
    }

    public function add($a_title,$outline='',$a_content,$tag_id,$imgs=[],$id) {
        //$user = User::init();
        $user = UserModel::get($id);
        $article = ArticleModel::create([
            'a_title' =>$a_title,
            'a_content' =>$a_content,
            'outline' => $outline,
            //'a_img' => $a_img,
            'tag_id' => $tag_id,
            'user_id' =>$user['user_id']
        ]);
        if(!$article) {
            throw new ResourcesException();
        }
        //Images::addImages($imgs,$article->a_id,'article',$id);
        return new Response();
    }

    public function update($a_id,$a_title,$outline='',$a_img=0,$a_content,$tag_id,$imgs=[]) {
        $article = ArticleModel::get($a_id);
        if(empty($article)) {
            throw new ResourcesException();
        }
        $user = User::init();
        if($article->user_id != $user['user_id']) {
            throw new AuthException();
        }
        $article->a_title = $a_title;
        $article->a_content = $a_content;
        $article->outline = $outline;
        $article->a_img = $a_img;
        $article->tag_id = $tag_id;
        $article->save();
        Images::addImages($imgs,$article->a_id,'article');
        return new Response();
    }
    public function addpageview($id) {
        
        $article = ArticleModel::get($id);
        $article->setInc('viewer_num');
        
        return new Response();
    }
}