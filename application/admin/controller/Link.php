<?php
namespace app\admin\controller;

use app\admin\model\Link as LinkModel;
use app\admin\controller\Common;
class link extends Common
{
    
    public function lst()
    {

        // if (request()->isPost()) {
        //     $sort = input('post.');
        //     foreach ($$sorts as $k => $v) {
        //         $cate->update(['id'=>$k,'sort'=>$v]);
        //     }
        //     $this->success('更新排序成功',url('lst'));
        //     return;
        // }
        $linkres = LinkModel::paginate(5);
        $this->assign('linkres',$linkres);
        return view('list');
    }

    public function add(){
        if (request()->isPost()) {
            $data = input('post.');

            // $validate = \think\Loader::validate('Link');
            $validate = new \app\admin\validate\Link;

            if (!$validate->scene('add')->check($data)) {
                // dump($validate->getError());
                $this->error($validate->getError());
            }

            $add = db('link')->insert($data);
            if ($add) {
                $this->success('添加成功',url('lst'));
            }else{
                $this->error('添加失败');
            }
        }
        return view();
    }

    public function del(){
        $del = LinkModel::destroy(input('id'));
        if ($del) {
            $this->success('删除成功',url('lst'));
        }else{
            $this->error('删除失败');
        }
    }
    // thinkphp5.1,模型中save方法，sql影响行数为0也返回true。
    // 5.0返回影响的行数，5.1返回布尔值;

    public function edit(){
        if (request()->isPost()) {
            // dump(input('post.'));die;
            $validate = new \app\admin\validate\Link;
            $data = input('post.');
            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
            }

            $link = new LinkModel();
            $res = $link->update($data,['id'=>$data['id']]);
            // dump($res);die;
            if ($res!==false) {
                $this->success('编辑成功',url('lst'));
            }else{
                $this->error('编辑失败');
            }
            return;
        }
        $links = LinkModel::find(input('id'));
        $this->assign('links',$links);
        return view();
    }
}
