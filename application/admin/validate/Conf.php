<?php
namespace app\admin\validate;
use think\Validate;
class Conf extends validate
{
    
    protected $rule =   [
        'cnname'  => 'unique:conf|require|max:60',
        'enname' => 'unique:conf|require|max:60',   
        'type'   => 'require',
         
    ];
    
    protected $message  =   [
        'cnname.require' => '中文名称不得为空',
        'cnname.max' => '中文名称长度不得大于60个字符',
        'cnname.unique' => '中文名称已存在',
        'enname.require' => '英文名称不得为空',
        'enname.max' => '英文名称不得大于60个字符',
        'enname.unique' => '英文名称已存在',
        'type.require' => '配置类型不得为空',
         
    ];

    protected $scene=[
        'add' => ['cnname','enname','type'],
        'edit' => ['cnname','enname'],

    ];

}
