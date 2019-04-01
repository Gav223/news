<?php
namespace app\index\service;

use app\common\status\NewsSource;
use app\index\model\News;
use think\exception\DbException;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-1
 * Time: 下午8:50
 */
class NewsService
{
    public function req2model($request)
    {
        $model = [];
        $model['title'] = $request['title'];
        $model['description'] = $request['description'];
        $model['source'] = NewsSource::$USER_ADD;
        $model['uid'] = cookie('uid');
        return $model;
    }

    /**
     * 发布文章
     */
    public function releaseNews($request)
    {
        $model = $this->req2model($request);
        try {
            News::create($model);
            log('文章发布成功', 'uid:'.cookie('uid'));
            return json();
        } catch (DbException $exception) {
            log('文章发布失败', 'uid:'.cookie('uid').'原因:'.$exception->getMessage());
            return json();
        }
    }
}