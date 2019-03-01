<?php
namespace app\admin\controller;
// use think\Controller;
// use think\Db;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
use app\admin\controller\Common;
class Article extends Common
{
    public function lst(){
        $article = db('article')->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid = b.id')->order('a.id desc')->paginate(5);
        // dump($article);die;
        $this->assign('data',$article);
        return view('list');
    }
    
    public function add(){

        if (request()->isPost()) {
            $data = input('post.');
            $data['time'] = time();

            $validate = new \app\admin\validate\Article;

            if (!$validate->scene('add')->check($data)) {
                // dump($validate->getError());
                $this->error($validate->getError());
            }

            $article = new ArticleModel;
            // if ($_FILES['thumb']['tmp_name']) {
            //     $file = request()->file('thumb');
            //     // 移动到框架应用根目录/uploads/ 目录下
            //     $info = $file->move( '../public/uploads');
            //     if ($info) {
            //         $thumb =  '../public/uploads'.'/'.$info->getSaveName();
            //         $data['thumb'] = $thumb;
            //     }
            // }

            // dump($data);die;
            if ($article->save($data)) {
                $this->success('添加成功',url('lst'));
            }else{
                $this->error('添加失败');
            }
            return;
        }


        $cate = new  CateModel();//实例化模型查询
        $cateres = $cate->catetree();
        $this->assign('caters',$cateres);
        return view();
    }


    public function edit(){

        if(request()->isPost()) {
            $data = input('post.');
            // dump($data);die;
            $validate = new \app\admin\validate\Article;

            if (!$validate->scene('edit')->check($data)) {
                // dump($validate->getError());
                $this->error($validate->getError());
            }

            $article = new ArticleModel;
            $save = $article->update($data);
            // dump($save);die;
            if ($save) {
                $this->success('修改成功',url('lst'));
            }else{
                $this->error('修改失败');
            }
            return;
        }

        $cate = new  CateModel();//实例化模型查询
        $cateres = $cate->catetree();
        $arts = db('article')->where(array('id'=>input('id')))->find();
        $this->assign('caters',$cateres);
        $this->assign(array(
                'caters'=>$cateres,
                'arts'=>$arts,
            ));
        return view();
    }

    public function del(){

        $res = ArticleModel::destroy(input('id'));

        if ($res) {
            $this->success('删除成功',url('lst'));
        }else{
            $this->error('删除失败');
        }
    }
}
