<?php
namespace app\index\controller;
use app\index\model\Article;
class Artlist extends Common
{
    public function index()
    {
    	$artlist = new Article();
    	$cateid=input('cateid');
    	$artRes = $artlist->getAllArticles($cateid);
    	$hotRes = $artlist->getHotRes($cateid);
    	$this->assign(array(
    		'artRes'=>$artRes,
    		'hotRes'=>$hotRes
    	));
        return view('artlist');
    }
}
