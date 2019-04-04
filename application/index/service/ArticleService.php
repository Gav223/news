<?php
namespace app\index\service;

use app\common\lib\Code;
use app\common\lib\Message;
use app\common\lib\message\ArticleMessage;
use app\common\lib\status\ArticleStatus;
use app\common\lib\status\NewsSource;
use app\common\model\Article;
use app\common\validate\ArticleValidate;
use think\Exception;
use think\exception\DbException;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-1
 * Time: 下午8:50
 */
class ArticleService
{

    /**
     * 请求数据2数据库数据
     * @param $request
     * @return array
     */
    public static function req2model($request)
    {
        $model = [];
        $model['title'] = $request['title'];
        $model['description'] = $request['description'];
        $model['source'] = NewsSource::$USER_ADD;
        $model['uid'] = cookie('uid');
        $model['image_url'] = $request['image_url'];
        $model['category_id'] = $request['category_id'];
        $model['content'] = $request['content'];
        $model['create_time'] = time();
        return $model;
    }

    /**
     * 发布文章
     * @param $requestParam
     * @return \think\response\Json
     */
    public static function releaseNews($requestParam)
    {
        $validate = new ArticleValidate();
        if ($validate->scene('insert')->check($requestParam) === false) {
            log4(ArticleMessage::$FAIL, $requestParam, $validate->getError(), 'error');
            return json(['code' => Code::$PARAM_ERROR, 'message' => $validate->getError()]);
        }
        try {
            $model = self::req2model($requestParam);
            $result = Article::create($model);
            log4(ArticleMessage::$SUCCESS, "article_id:{$result->getLastInsID()}");
            return json(['code' => Code::$SUCCESS, 'message' => ArticleMessage::$SUCCESS]);
        } catch (Exception $exception) {
            log4(ArticleMessage::$FAIL, $exception, $exception->getMessage(), 'error');
            return json(['code' => Code::$FAIL, 'message' => ArticleMessage::$FAIL]);
        }
    }

    /**
     * 获取文章详情
     * @param $requestParam
     * @return array|\PDOStatement|string|\think\Model|null
     */
    public static function getArticleDetails($requestParam)
    {
        $articleId = $requestParam['id'];
        return Article::findOneByCondition(['id' => $articleId]);
    }

    /**
     * 查询最新n篇文章
     * @param int $limit
     * @return mixed
     */
    public static function getNewArticleList($limit = DEFAULT_SHOW_NUM)
    {
        $articleList = Article::findByCondition(['status' => ArticleStatus::$WAIT_TO_CHECK], '', ['id' => 'desc'], $limit);
        return ArticleCategoryService::setCategoryName($articleList);
    }
}