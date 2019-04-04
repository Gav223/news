<?php
namespace app\index\controller;

use app\index\service\ArticleService;
use think\Controller;

class Index extends Controller
{

    public function index()
    {
        $articleList = ArticleService::getNewArticleList(DEFAULT_SHOW_NUM);
        return view('index', ['list' => $articleList]);
    }
}
