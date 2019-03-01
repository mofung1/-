<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller
{
    public function initialize()
    {   
        // 当前位置判断是cateid 还是artid
        if (input('cateid')) {
            $this->getPos(input('cateid'));
        }
        if (input('artid')) {
            $articles = db('article')->field('cateid')->find(input('artid'));
            $cateid = $articles['cateid'];
            $this->getPos($cateid);
        }
        // 网站配置项
        $this->getConf();
        // 网站栏目导航
        $this->getNavCates();
        $cateM = new \app\index\model\Cate();
        $recBottom = $cateM->getBottomRec();
        $this->assign('recBottom',$recBottom);
    }

    public function getNavCates(){
        // 顶级栏目
        $cateres = db('cate')->where(array('pid'=>0))->select();
        foreach ($cateres as $k => $v) {
            // 子栏目
            $children = db('cate')->where(array('pid'=>$v['id']))->select();
            if ($children) {
                // 有子级栏目
                $cateres[$k]['children'] = $children;
            }else{
                $cateres[$k]['children'] = 0;
            }
        }

        $this->assign('cateres',$cateres);
    }

    public function getConf(){
        $conf = new \app\index\model\Conf();
        $_confres = $conf->getAllConf();
        $confres = array();
        foreach ($_confres as $k => $v) {
            $confres[$v['enname']] = $v['cnname'];
        }
        $this->assign('confres',$confres);
    }

    // 当前位置
    public function getPos($cateid){
        $cate =new \app\index\model\Cate();
        $posArr = $cate->getParents($cateid);
        $this->assign('posArr',$posArr);
    }

}

