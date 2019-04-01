<?php
namespace app\index\controller;

use think\Request;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-3-31
 * Time: 下午10:25
 */
class News
{
    public function releaseNews(Request $request)
    {
        if ($request->isGet()) {
            return view('release');
        }
    }
}