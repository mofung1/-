<?php
namespace app\admin\validate;
use think\Validate;
class link extends validate
{
    
    protected $rule =   [
        'title'  => 'unique:link|require|max:25',
        'url' => 'unique:link|require|url|max:60',   
        'desc'   => 'require',
         
    ];
    
    protected $message  =   [
        'title.require' => '链接标题不得为空',
        'title.max' => '链接标题长度不得大于25个字符',
        'title.unique' => '链接标题已存在',
        'url.require' => 'url不得为空',
        'url.max' => 'url长度不得大于60个字符',
        'url.url' => 'url格式不正确',
        'url.unique' => 'url已存在',
        'desc.require' => '描述不得为空',
         
    ];


    protected $scene=[
    	'add' => ['title','url','desc'],
    	'edit' => ['title','url'],

    ];

}
