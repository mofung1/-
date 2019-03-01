<?php
namespace app\admin\controller;

use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\controller\Common;
class AuthGroup extends Common
{
    public function lst(){
    	$authGroupRes = AuthGroupModel::paginate(6);
    	$this->assign('authGroupRes',$authGroupRes);
        return view('list');
    }
    

    public function add(){
    	if (request()->isPost()) {
    		$data = input('post.');

            if ($data['rules']) {
                $data['rules'] = implode(',', $data['rules']);
            }

            $validate = new \app\admin\validate\AuthGroup;
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

    		$add = db('auth_group')->insert($data);
    		if ($add) {
    			$this->success('添加用户组成功',url('lst'));
    		}else{
    			$this->error('添加用户组失败');
    		}
    		return;
    	}
        $authRule=new \app\admin\model\AuthRule();
        $authRuleRes=$authRule->authRuleTree();
        $this->assign('authRuleRes',$authRuleRes);
    	return view();
    }

    public function edit(){
    	if (request()->isPost()) {
    		$data = input('post.');
            if ($data['rules']) {
                $data['rules'] = implode(',', $data['rules']);
            }
    		if (!isset($data['status'])) {
    			$data['status'] = 0;
    		}
            $validate = new \app\admin\validate\AuthGroup;
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
    		$save = db('auth_group')->update($data);
    		if ($save) {
    			$this->success('修改用户组成功',url('lst'));
    		} else {
    			$this->error('修改用户组失败');
    		}
    		
    		return;
    	} 
    	
    	$id = input('id');
    	$authgroups = db('auth_group')->find($id);

        $authRule=new \app\admin\model\AuthRule();
        $authRuleRes=$authRule->authRuleTree();
        $this->assign(array(
                'authRuleRes'=>$authRuleRes,
                'authgroups'=>$authgroups
            ));

    	return view();
    }

    public function del(){
    	$id = input('id');
    	$del = db('auth_group')->delete($id);
    	if ($del) {
    		$this->success('删除用户组成功',url('lst'));
    	} else {
    		$this->error('删除用户组失败');
    	}
    	
    }
}
