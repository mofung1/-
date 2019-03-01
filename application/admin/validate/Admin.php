<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends validate
{
    
    protected $rule =   [
        'name'  => 'unique:admin|require|max:25',
        'password' =>'require|min:6'
    ];
    
    protected $message  =   [
        'name.require' => '名称不得为空',
        'name.unique' => '名称已存在',
        'password.require' => '密码不得为空',
        'password.min' => '密码不得少于6位',
         
    ];


    protected $scene=[
    	'add' => ['name','password'],
    	'edit' => ['name','password'],

    ];

}
