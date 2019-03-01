<?php
namespace app\admin\controller;

use app\admin\model\AuthRule as AuthRuleModel;
use app\admin\controller\Common;
class AuthRule extends Common
{
    
    public function lst()
    {
        $authRule = new AuthRuleModel();
        if (request()->isPost()) {
            $sorts = input('post.');
            foreach ($sorts as $k => $v) {
               $authRule->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('排序成功',url('lst'));
           return;
        }

        $authRule = new AuthRuleModel();
        $authRuleRes = $authRule->authRuleTree();
        $this->assign('authRuleRes',$authRuleRes);
        return view('list');
    }

    public function add(){
        if (request()->isPost()) {
            $data = input('post.');
            $plevel = db('auth_rule')->where('id',$data['pid'])->field('level')->find();
            if ($plevel) {
                $data['level'] = $plevel['level'] + 1;
            }else{
                $data['level'] = 0;
            }

            $validate = new \app\admin\validate\AuthRule;
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            
            $add = db('auth_rule')->insert($data);
            if ($add) {
                $this->success('添加权限成功',url('lst'));
            } else {
                $this->error('添加失败');
            }
            return;
            
        }
        $authRule = new AuthRuleModel();
        $authRuleRes = $authRule->authRuleTree();
        $this->assign('authRuleRes',$authRuleRes);
        return view();
    }


    public function edit(){

        if (request()->isPost()) {
            $data = input('post.');

            $plevel = db('auth_rule')->where('id',$data['pid'])->field('level')->find();
            if ($plevel) {
                $data['level'] = $plevel['level'] + 1;
            }else{
                $data['level'] = 0;
            }

            $validate = new \app\admin\validate\AuthRule;
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            $save = db('auth_rule')->update($data);
            if ($save !== false) {
                $this->success('修改权限成功',url('lst'));
            } else {
                $this->error('修改权限失败');
            }
            return;
        }


        $authRule = new AuthRuleModel();
        $authRuleRes = $authRule->authRuleTree();
        $authRules = $authRule->find(input('id'));
        $this->assign(array(
                'authRuleRes'=>$authRuleRes,
                'authRules'=>$authRules,
            ));
        return view();
    }


    public function del(){
       $id = input('id');
       $authRule = new AuthRuleModel();
       $authRuleIds = $authRule->getchilrenid($id);
       $authRuleIds[] = $id;
       $del = $authRule->destroy($authRuleIds);
       if ($del) {
           $this->success('删除权限成功',url('lst'));
       } else {
           $this->error('删除权限失败');
       }
       
    }


}
