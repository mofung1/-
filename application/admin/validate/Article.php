<?php
namespace app\admin\validate;
use think\Validate;
class Article extends validate
{
    
    protected $rule =   [
        'title'  => 'unique:article|require|max:25',
        'cateid'   => 'require',
        'content'   => 'require',
         
    ];
    
    protected $message  =   [
        'title.require' => '标题不得为空',
        'title.max' => '标题长度不得大于25个字符',
        'title.unique' => '标题已存在',
        'cateid.require' => '文章栏目不得为空',
        'content.require' => '内容不得为空',
         
    ];


    protected $scene=[
    	'add' => ['title','cateid','content'],
    	'edit' => ['title','cateid'],

    ];

}
