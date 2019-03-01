<?php
namespace app\admin\controller;
use think\Controller;
class Common extends Controller
{
	// 控制器初始化
    public function initialize(){
        if (!session('id') || !session('name')) {
            $this->error('您尚未登录',url('login/index'));
        }

        $auth = new Auth();

        // 当前控制器名
        $con = request()->controller();
        // 当前方法名
        $action = request()->action();
        $name = $con.'/'.$action;
        $notCheck=array('Index/index','Admin/lst','Admin/logout');
         if(session('id')!=1){
        	if(!in_array($name, $notCheck)){
        		if(!$auth->check($name,session('id'))){
		    	$this->error('没有权限',url('index/index')); 
		    	}
        	}
        	
        }
 


    }
}
