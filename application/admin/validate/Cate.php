<?php
namespace app\admin\validate;
use think\Validate;
class Cate extends validate
{
    
    protected $rule =   [
        'catename'  => 'unique:cate|require|max:25',
    ];
    
    protected $message  =   [
        'catename.require' => '栏目名称不得为空',
        'catename.unique' => '栏目名称已存在',
         
    ];


    protected $scene=[
    	'add' => ['catename'],
    	'edit' => ['catename'],

    ];

}
