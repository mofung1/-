<?php
namespace app\admin\controller;
// use app\admin\controller\Common;
class Index extends Common
{
    public function index()
    {
        return view();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
