<?php
namespace app\index\model;
use think\Model;
use app\index\model\Cate;
class Article extends Model
{
    public function getAllArticles($cateid)
    {
        $cate = new Cate();
        $allCateId =  $cate->getchilrenid($cateid);
        // dump($allCateId);die;
        $artRes = db('article')->where("cateid IN($allCateId)")->order('id desc')->paginate(5);
        // dump($artRes);die;
        return $artRes;
    }

    public function getHotRes($cateid)
    {
        $cate = new Cate();
        $allCateId =  $cate->getchilrenid($cateid);
        // dump($allCateId);die;
        $artRes = db('article')->where("cateid IN($allCateId)")->order('click desc')->limit(5)->select();
        // dump($artRes);die;
        return $artRes;
    }
    // 搜索页面推荐文章
    public function getSerHot(){
       $artRes=db('article')->order('click desc')->limit(5)->select();
        return $artRes; 
    }

    public function getNewArticle(){
        $newArticleRes = db('article')->alias('a')->join('bk_cate c','a.cateid=c.id')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,c.catename')->limit(5)->order('id desc')->select();
        return $newArticleRes;
    }

    public function getSiteHot(){
        $siteHot = $this->field('id,title,thumb')->limit(5)->order('click desc')->select();
        return $siteHot;
    }

    public function getRecArt(){
        $recArt = $this->where('rec',1)->field('id,thumb,title')->order('id desc')->limit(4)->select();
        return $recArt;
        // dump($recArt);die;
    }
}

