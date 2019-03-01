<?php
namespace app\admin\controller;

use app\admin\model\Conf as ConfModel;
use app\admin\controller\Common;
class Conf extends Common
{
    
    public function lst(){
        if (request()->isPost()) {
            $sorts = input('post.');
            $conf = new ConfModel();
            foreach ($sorts as $k => $v) {
                $conf->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('排序成功',url('lst'));
        }
        
        $confres = ConfModel::order('sort desc')->paginate(5);
        $this->assign('confres',$confres);
        return view('list');
   }

    public function add(){
        if (request()->isPost()) {
            $data = input('post.');

            if ($data['values']) {
                $data['values'] = str_replace('，', ',', $data['values']);
            }

            $validate = new \app\admin\validate\Conf;

            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
            }

            $conf = new ConfModel();
            if ($conf->save($data)) {
                $this->success('添加成功',url('lst'));
            }else{
                $this->error('添加失败');
            }
        }
        return view();
   }

    public function edit(){
        
        if (request()->isPost()) {
            $data = input('post.');
            // 验证
            $validate = new \app\admin\validate\Conf;

            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
            }

            $conf = new ConfModel();
            if ($data['values']) {
                $data['values'] = str_replace('，', ',', $data['values']);
            }
            $save = $conf->save($data,['id'=>$data['id']]);
            if ($save !== false) {
                $this->success('修改成功',url('lst'));
            }else{
                $this->error('修改失败');
            }
        }
        $confs = ConfModel::find(input('id'));
        $this->assign('confs',$confs);
        return view();
   }

    public function del(){
        $del = ConfModel::destroy(input('id'));
        if ($del) {
            $this->success('删除成功',url('lst'));
        }else{
            $this->error('删除失败');
        }
        return view();
   }


    public function conf(){

        if(request()->isPost()){
            $data=input('post.');
            $formarr=array();
            foreach ($data as $k => $v) {
                $formarr[]=$k;
            }
            $_confarr=db('conf')->field('enname')->select();
            $confarr=array();
            foreach ($_confarr as $k => $v) {
                $confarr[]=$v['enname'];
            }
            $checkboxarr=array();
            foreach ($confarr as $k => $v) {
                if(!in_array($v, $formarr)){
                    $checkboxarr[]=$v;
                }
            }
            if($checkboxarr){
                foreach ($checkboxarr as $ke => $v) {
                    ConfModel::where('enname',$v)->update(['value'=>'']);
                }
            }
            if($data){
            
                foreach ($data as $k=>$v) {
                    ConfModel::where('enname',$k)->update(['value'=>$v]);
                }

                $this->success('修改配置成功！');

            }
            return;
        }
        $confres=ConfModel::order('sort desc')->select();
        $this->assign('confres',$confres);
        return view();
    }
}
