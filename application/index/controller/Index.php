<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Cookie;
use app\common\model\Article;

class Index extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (Cookie::has('openid') === false) {
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APP_ID."&redirect_uri=".urlencode('http://article.leephp.cn/silentAuthCallBack')."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
            $this->redirect($url);
        } else {
            $articleList = Article::findByCondition();
            return view();
        }
    }
}
