<?php
namespace app\admin\controller;
// use think\Controller;
// use think\Db;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
use app\admin\controller\Common;
class cate extends Common
{
    // 前置操作
    protected $beforeActionList = [
        // 'first',
        // 'second' =>  ['except'=>'hello'],
        'delsoncate'  =>  ['only'=>'del'],
    ];

    public function lst()
    {
        $cate = new  CateModel();//实例化模型查询
        $cateres = $cate->catetree();
        $this->assign('data',$cateres);
        // dump($cateres);
        return view('list');
    }

    public function add(){
        $cate = new  CateModel();//实例化模型查询
        if (request()->isPost()) {
            $data = input('post.');

            $validate = new \app\admin\validate\Cate;

            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
            }

            $cate->data($data);
            $add = $cate->save();
            if ($add) {
                $this->success('添加栏目成功!',url('lst'));
            }else{
                $this->error('添加失败!');
            }
        }
        $cateres = $cate->catetree();
        $this->assign('caters',$cateres);
        return view();
    }

    public function del(){
        $del = db('cate')->delete(input('id'));
        if ($del) {
           $this->success('删除成功！',url('lst'));
        }else{
            $this->error('删除失败！');
        }
    }

    public function delsoncate(){
        $cateid = input('id');//要删除的当前栏目id
        $cate = new CateModel();
        $sonids = $cate->getchilrenid($cateid);
        // dump($sonids);die;
        $allcateid = $sonids;
        $allcateid[] = $cateid;
        foreach ($allcateid as $k => $v) {
            $article = new ArticleModel;
            $article->where(array('cateid'=>$v))->delete();
        }
        if ($sonids) {
            db('cate')->delete($sonids);
        }
        
    }

    public function edit(){
        $cate = new CateModel();

        if (request()->isPost()) {

            $data = input('post.');

            $validate = new \app\admin\validate\Cate;

            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
            }

            $save = $cate->save($data,['id'=>$data['id']]);
            // echo '2222';return;
            if ($save !== false) {
                $this->success('修改成功',url('lst'));
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $cates = $cate->find(input('id'));
        $cateres = $cate->catetree();
        $this->assign(array(
            'cateres'=>$cateres,
            'cates'=>$cates,
            ));
        return  view();
    }
    
}
