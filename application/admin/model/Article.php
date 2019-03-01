<?php
namespace app\admin\model;
use think\Model;
class Article extends Model
{
    

    protected static function init()
    {
    	//模型事件
        Article::event('before_insert', function ($data) {
             if ($_FILES['thumb']['tmp_name']) {
                $file = request()->file('thumb');
               // 移动到框架应用根目录/uploads/ 目录下
                $info = $file->move( '../public/uploads');
                if ($info) {
                    $thumb =  '/bike/'.'public/uploads'.'/'.$info->getSaveName();
                    $data['thumb'] = $thumb;
                }
            }
        });


        //模型事件
        Article::event('before_update', function ($data) {
             if ($_FILES['thumb']['tmp_name']) {
                $arts = Article::find($data->id);
                $thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
                if (file_exists($thumbpath)) {
                    @unlink($thumbpath);
                }

                $file = request()->file('thumb');
               // 移动到框架应用根目录/uploads/ 目录下
                $info = $file->move( '../public/uploads');
                if ($info) {
                    $thumb =  '/bike/'.'public/uploads'.'/'.$info->getSaveName();
                    $data['thumb'] = $thumb;
                }
            }
        });

        Article::event('after_delete', function ($data) {
                //执行删除之后删除图片
                $arts = Article::find($data->id);
                $thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
                if (file_exists($thumbpath)) {
                    @unlink($thumbpath);
                }

        });

    }

        

}
