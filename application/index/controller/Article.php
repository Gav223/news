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
     * 发布新闻
     * @param Request $request
     * @return \think\response\Json|\think\response\View
     */
    public function releaseArticle(Request $request)
    {
        if ($request->isGet()) {
            $categoryList = ArticleCategory::findByCondition();
            return view('release', ['categoryList' => $categoryList]);
        } else {
            //用户发布文章
            return ArticleService::releaseNews($request->param());
        }
    }
}