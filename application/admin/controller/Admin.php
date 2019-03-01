<?php
namespace app\admin\controller;
// use think\Controller;
use think\Db;
use app\admin\model\Admin as AdminModel;
class Admin extends Common
{

    public function lst()
    {
        //1 $res = db('admin')->field('name,id')->select();//助手函数查询
        //2 $admin = new  AdminModel();//实例化模型查询
        // $res = $admin->select();
                // foreach ($$res as $key => $value) {
        //     echo $value->name;
        //     echo "<br>";
        // }
        //3静态方法，不需要实例化对象
        // $res = AdminModel::getByName('2');
        //4
        // $auth=new Auth();
    
        // $admin = new  AdminModel();//实例化模型查询
        // $adminres = $admin->getadmin();
        $adminres = Db::table('bk_admin')
                    ->alias('a')
                    ->join('auth_group_access b','b.uid = a.id')
                    ->join('auth_group c','c.id = b.group_id')
                    ->paginate(5);

        $this->assign('data',$adminres);
        return view('list');
    }

    public function add()
    {
        // dump($_POST);die;
        if (request()->isPost()) {
            $data = input('post.');
            // dump($data); die;
            // $res=db('admin')->insert($data);//助手函数
            // $res = Db::name('admin')->insert($data);

            $validate = new \app\admin\validate\Admin;

            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
            }

            $admin = new  AdminModel();//initialize()初始化后不用再实力化
            // $admin->addadmin($data);

            if ($admin->addadmin($data)) {
                $this->success('添加管理员成功！',url('admin/lst'));
            }else{ 
                $this->error('添加失败!');
            }
            return;
        }

        $authGroupRes = db('auth_group')->select();
        $this->assign('authGroupRes',$authGroupRes);

        return view();
    }

    // public function edit($id)
    // {
    //     $admins = db('admin')->find($id);
    //     if (request()->isPost()) {
    //         // dump($_POST);die;
    //         $data = input('post.');
    //         if (!$data['name']) {
    //             $this->error('管理员用户名不能为空');
    //         }
    //         if (!$data['password']) {
    //             $data['password'] = $admins['password'];
    //         }else{
    //             $data['password'] = md5($data['password']);
    //         }
    //         $res = db('admin')->update($data);
    //         if ($res !== false) {
    //             $this->success('修改管理员成功！',url('admin/lst'));
    //         }else{
    //             $this->error('修改失败!');
    //         }
    //         return;
    //     }
        
    //     if (!$admins) {
    //         $this->error('该管理员不存在');
    //     }
    //     $this->assign('admin',$admins);
    //     return view();
    // }


    public function edit($id)
    {
        $admins = db('admin')->find($id);
        if (request()->isPost()) {
            // dump($_POST);die;
            $data = input('post.');

            $validate = new \app\admin\validate\Admin;

            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
            }


            $admin =new AdminModel();
            $savenum = $admin->saveadmin($data,$admins);
                
            if ($savenum == '2') {
                $this->error('管理员用户名不能为空！');
            }

            if ($savenum !== false) {
                $this->success('修改成功！',url('admin/lst'));
            }else{
                $this->error('修改失败!');
            }
            return;
        }
        
        if (!$admins) {
            $this->error('该管理员不存在');
        }

        $authGroupAccess=db('auth_group_access')->where(array('uid'=>$id))->find();

        $authGroupRes = db('auth_group')->select();
        $this->assign(array(
            'authGroupRes'=>$authGroupRes,
            'admin'=>$admins,
            'groupId'=>$authGroupAccess['group_id']
        ));
        return view();
    }

    public function del($id){
        $admin = new AdminModel();
        $delnum = $admin->deladmin($id);
        if ($delnum == '1') {
            $this->success('删除成功！',url('admin/lst'));
        }else{
            $this->error('删除失败!');
        }
    }

    public function logout(){
        session(null);
        $this->success('退出成功',url('login/index'));
    }

    
}
