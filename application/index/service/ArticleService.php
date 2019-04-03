<?php
namespace app\index\service;

use app\common\lib\Code;
use app\common\lib\Message;
use app\common\lib\status\NewsSource;
use app\common\validate\ArticleValidate;
use app\index\model\Article;
use think\exception\DbException;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-1
 * Time: 下午8:50
 */
class ArticleService
{

    public static function req2model($request)
    {
        $model = [];
        $model['title'] = $request['title'];
        $model['description'] = $request['description'];
        $model['source'] = NewsSource::$USER_ADD;
        $model['uid'] = cookie('uid');
        $model['create_time'] = time();
        return $model;
    }

    /**
     * 发布文章
     */
    public static function releaseNews($request)
    {
        $validate = new ArticleValidate();
        if ($validate->scene('insert')->check($request) === false) {
            return json(['code' => Code::$PARAM_ERROR, 'message' => $validate->getError()]);
        }
        $model = self::req2model($request);
        try {
            Article::create($model);
            log4('文章发布成功', 'uid:'.cookie('uid'));
            return json(['code' => Code::$SUCCESS, 'message' => Message::$SUCCESS]);
        } catch (DbException $exception) {
            log4('文章发布失败', 'uid:'.cookie('uid').'原因:'.$exception->getMessage());
            return json(['code' => Code::$FAIL, 'message' => Message::$FAIL]);
        }
    }
}