<?php
namespace app\index\controller;

use app\index\service\IndexService;
use think\Controller;
use think\facade\Cookie;
use think\facade\Log;
use think\Request;

class Index extends Controller
{

    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new IndexService();
    }

    public function index()
    {
        if (Cookie::has('openid') === false) {
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APP_ID."&redirect_uri=".urlencode('http://news.leephp.cn/silentAuthCallBack')."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
            Log::info('获取用户信息url:'.$url);
            $this->redirect($url);
        } else {
            Log::info('cookie:{cookie}', ['cookie' => Cookie::get('userInfo')]);
            return view();
        }
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
    
    public function test()
    {
	    return urlencode('http://139.199.60.237/news/public/index.php/index/Index/getUserBaseInfo');
    }

    /**
     * 接口配置
     */
    public function wxTest(Request $request)
    {
        $reqData = $request->param();
        Log::write('reqData:'.json_encode($reqData));
        $signature = $this->service->getSignature($reqData['timestamp'], $reqData['nonce']);
        Log::write('signature:'.$signature);
        if ($signature == $reqData['signature']) {
            Log::write('校验成功');
            return $reqData['echostr'];
        } else {
            Log::write('校验失败');
            return false;
        }
    }

    public function getUserBaseInfo(Request $request)
    {
        return $this->service->getUserBaseInfo($request->param()['code']);
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo($userBaseInfo)
    {
        $userInfo = $this->service->getUserInfo($userBaseInfo['access_token'], $userBaseInfo['openid']);
        return json_encode($userInfo);
    }

    /**
     * 静默授权回调(通过code换取userBaseInfo)
     * @param Request $request
     * @return mixed
     */
    public function silentAuthCallBack(Request $request)
    {
        Log::info('获取用户信息');
        $code = $request->param()['code'];
        $wxUserBaseInfo = $this->service->getUserBaseInfo($code); //通过code换取用户基本信息(access_token与openid)
        Log::info('code:{code}|wxUserBaseInfo:{wxUserBaseInfo}', ['code' => $code, 'wxUserBaseInfo' => json_encode($wxUserBaseInfo)]);
        $userInfo = $this->service->getUserInfoByOpenid($wxUserBaseInfo['openid']); //查询用户数据(数据库)
        Log::info('userInfo:{userInfo}', ['userInfo' => $userInfo]);
        if ($userInfo === null) {    //用户不在用户体系中
            $wxUserInfo = $this->service->getUserInfo($wxUserBaseInfo['access_token'], $wxUserBaseInfo['openid']);
            //TODO 1.存数据库，存cookie
            $this->service->insertUserInfo($this->service->wxUserInfo2domain($wxUserInfo));
            $userInfo = $this->service->getUserInfoByOpenid($wxUserBaseInfo['openid']);
        }
        $this->service->setUserInfoCookie($userInfo);
        $this->redirect('index');
    }
}
