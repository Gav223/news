<?php
namespace app\index\controller;

use app\common\model\ArticleCategory;
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
     * 发布新闻(请求方式为GET:展示页面|POST:发布文章)
     * @param Request $request
     * @return \think\response\Json|\think\response\View
     */
    public function releaseArticle(Request $request)
    {
        if ($request->isGet()) {
            //展示页面
            $categoryList = ArticleCategory::findByCondition();
            return view('release', ['categoryList' => $categoryList]);
        } else {
            //发布文章
            return ArticleService::releaseNews($request->param());
        }
    }

    /**
     * 新闻详情
     * @param Request $request
     * @return \think\response\View
     */
    public function detail(Request $request)
    {
        $article = ArticleService::getArticleDetails($request->param());
        return view('detail', ['article' => $article]);
    }
}