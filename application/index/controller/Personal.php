<?php
namespace app\index\controller;

use app\index\service\IndexService;
use think\Controller;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 3/17/19
 * Time: 6:50 PM
 */
class Personal extends Controller
{
    private $indexService;
    public function __construct()
    {
        $this->indexService = new IndexService();
    }

    /**
     * 模拟这是主页
     * TODO 1.获取openid，如果在用户表中则查询用户数据赋值
     * TODO 2.如果没在用户表中，则获取用户信息，然后赋值
     * @return \think\response\View
     */
    public function index()
    {
        return view();
        $userBaseInfo = curl('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx985089ba7e56c17d&redirect_uri=http%3A%2F%2F139.199.60.237%2Fwxtest%2Fpublic%2Findex.php%2Findex%2FIndex%2FgetUserBaseInfo&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect', 'get');
        halt($userBaseInfo);
    }
}