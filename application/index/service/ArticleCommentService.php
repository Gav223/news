<?php
namespace app\index\service;

use app\common\lib\Code;
use app\common\lib\message\CommentMessage;
use app\common\model\ArticleComment;
use app\common\validate\ArticleCommentValidate;
use think\Exception;
use think\facade\Session;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-4
 * Time: 上午10:45
 */
class ArticleCommentService
{
    private $validate;

    public function __construct()
    {
        $this->validate = new ArticleCommentValidate();
    }

    /**
     * 请求参数转换成数据数组
     * @param $requestParam
     * @return array
     */
    public static function req2model($requestParam)
    {
        $model = [];
        $model['uid'] = Session::get('uid');
        $model['article_id'] = $requestParam['article_id'];
        $model['create_time'] = time();
        return $model;
    }

    /**
     * 发布评论
     * @param $requestParam
     * @return \think\response\Json
     */
    public function releaseComment($requestParam)
    {
        if ($this->validate->scene('insert')->check($requestParam) === false) {
            log4(CommentMessage::$FAIL, $requestParam, $this->validate->getError(), 'error');
            return json(['code' => Code::$PARAM_ERROR, 'message' => $this->validate->getError()]);
        }
        try {
            $article = ArticleComment::create(self::req2model($requestParam));
            log4(CommentMessage::$SUCCESS, 'comment_id:'.$article->getLastInsID());
            return json(['code' => Code::$SUCCESS, 'message' => CommentMessage::$SUCCESS]);
        } catch (Exception $exception) {
            log4(CommentMessage::$FAIL, $exception, $exception->getMessage(), 'error');
            return json(['code' => Code::$ERROR, 'message' => CommentMessage::$FAIL]);
        }
    }

    /**
     * 获取最新的n条评论
     * @param $limit
     * @return array|\PDOStatement|string|\think\Collection
     */
    public static function getNewComments($limit)
    {
        return ArticleComment::findByCondition([],'',['id' => 'desc'], $limit);
    }
}