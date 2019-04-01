<?php
namespace app\index\controller;

use app\index\service\ArticleService;
use think\Request;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-3-31
 * Time: 下午10:25
 */
class Article
{
    /**
     * 发布新闻
     * @param Request $request
     * @param ArticleService $service
     * @return \think\response\Json|\think\response\View
     */
    public function releaseArticle(Request $request, ArticleService $service)
    {
        if ($request->isGet()) {
            return view('release');
        } else {
            //用户发布文章
            return $service->releaseNews($request->param());
        }
    }
}