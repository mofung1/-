<?php
namespace app\admin\validate;
use think\Validate;
class AuthRule extends validate
{
    
    protected $rule =   [
        'title'  => 'unique:auth_rule|require|max:25',
        'name' => 'unique:auth_rule|require|max:25',   
         
    ];
    
    protected $message  =   [
        'title.require' => '权限名称不得为空',
        'title.max' => '权限名称长度不得大于25个字符',
        'title.unique' => '权限名称已存在',

        'name.require' => '控/方名称不得为空',
        'name.max' => '控/方长度不得大于25个字符',
        'name.unique' => '控/方已存在',
    ];


}
