<?php
namespace app\admin\validate;
use think\Validate;
class AuthGroup extends validate
{
    
    protected $rule =   [
        'title'  => 'unique:auth_group|require',
    ];
    
    protected $message  =   [
        'title.require' => '用户组名称不得为空',
        'title.unique' => '用户组名称已存在',
    ];


}
