<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
    	// 首页最新文章调用
    	$articleM = new \app\index\model\Article();
        // 最新文章
    	$articleRes = $articleM->getNewArticle();
        // 首页热点文章
        $siteHot = $articleM->getSiteHOt();
        // 推荐文章
        $recArt = $articleM->getRecArt();
        // 友情链接
        $linkRes = db('link')->limit(5)->order('id desc')->select();
        // 推荐栏目
        $cateM = new \app\index\model\Cate();
        $recIndex = $cateM->getIndexRec();
    	$this->assign(array(
    		'articleRes'=>$articleRes,
            'siteHot'=>$siteHot,
            'linkRes'=>$linkRes,
            'recArt'=>$recArt,
            'recIndex'=>$recIndex,
    	));
        return view();
    }
}

