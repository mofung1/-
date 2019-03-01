<?php
namespace app\admin\controller;
use app\admin\model\Admin;
use think\Controller;
use think\captcha\Captcha;
class Login extends Controller
{
    public function index()
    {	
    	if (request()->isPost()){
    		$data = input('post.');
            $code = input('code');

            $captcha = new Captcha();
            
            if( !$captcha->check($code))
            {
                $this->error('验证码错误！',url('Login/index'));
            }


    		$admin = new Admin();
    		$num = $admin->login($data);
    		if ($num == 1) {
    			$this->error('用户名不存在！');
    		}else if ($num == 2) {
    			$this->success('登录成功！',url('Index/index'));
    		}else if ($num == 3) {
    			$this->error('密码错误！');
    		}
    		return;
    	}
        return view();
    }


    public function verify(){

        $config =    [ 
            // 验证码位数
            'length'      =>    4,   
            // 关闭验证码杂点
            'useNoise'    =>    false, 
            'codeSet'     =>    '0123456789',
        ];

        $captcha = new Captcha($config);
        // $captcha->codeSet = '0123456789'; 
        // $captcha->useZh = true;
        // // 设置验证码字符
        // $captcha->zhSet = '们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这'; 
        return $captcha->entry();   
    }
}
