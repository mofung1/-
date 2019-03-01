<?php
namespace app\index\controller;
use app\index\model\Article;
class Imglist extends Common
{
    public function index()
    {	
    	$artlist = new Article();
    	$cateid=input('cateid');
    	$artRes = $artlist->getAllArticles($cateid);
    	$this->assign(array(
    		'artRes'=>$artRes,
    	));
        return view('imglist');
    }
}
