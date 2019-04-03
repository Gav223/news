<?php
namespace app\index\controller;

use app\index\service\IndexService;
use think\Controller;

class Index extends Controller
{

    public function index()
    {
        return view('index', ['list' => IndexService::getIndexResParam()]);
    }
}
