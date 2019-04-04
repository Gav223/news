<?php
namespace app\index\controller;

use app\index\service\ArticleCommentService;
use think\Controller;
use think\Request;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-4
 * Time: 上午10:18
 */
class ArticleComment extends Controller
{
    private $service;

    public function __construct(ArticleCommentService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 发布评论
     * @param Request $request
     * @return \think\response\Json
     */
    public function release(Request $request)
    {
        return $this->service->releaseComment($request->param());
    }
}