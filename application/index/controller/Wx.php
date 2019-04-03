<?php
namespace app\index\controller;

use app\index\service\UserService;
use app\index\service\WxService;
use think\App;
use think\Controller;
use think\facade\Log;
use think\Request;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-3
 * Time: 下午3:52
 */
class Wx extends Controller
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
    }

    /**
     * 微信测试号接口配置
     * @param Request $request
     * @return bool
     */
    public function apiConfig(Request $request)
    {
        $reqData = $request->param();
        Log::write('reqData:'.json_encode($reqData));
        $signature = WxService::getSignature($reqData['timestamp'], $reqData['nonce']);
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
        return WxService::getUserBaseInfo($request->param()['code']);
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo($userBaseInfo)
    {
        $userInfo = WxService::getUserInfo($userBaseInfo['access_token'], $userBaseInfo['openid']);
        return json_encode($userInfo);
    }

    /**
     * 微信授权回调(通过code换取userBaseInfo)
     * @param Request $request
     * @return mixed
     */
    public function wxAuthCallBack(Request $request)
    {
        Log::info('获取用户信息');
        $code = $request->param()['code'];
        $wxUserBaseInfo = WxService::getUserBaseInfo($code); //通过code换取用户基本信息(access_token与openid)
        Log::info('code:{code}|wxUserBaseInfo:{wxUserBaseInfo}', ['code' => $code, 'wxUserBaseInfo' => json_encode($wxUserBaseInfo)]);
        $userInfo = UserService::getUserInfoByOpenid($wxUserBaseInfo['openid']); //查询用户数据(数据库)
        Log::info('userInfo:{userInfo}', ['userInfo' => $userInfo]);
        if ($userInfo === null) {    //用户不在用户体系中
            $wxUserInfo = WxService::getUserInfo($wxUserBaseInfo['access_token'], $wxUserBaseInfo['openid']);
            //TODO 1.存数据库，存cookie
            UserService::insertUserInfo(UserService::wxUserInfo2domain($wxUserInfo));
            $userInfo = UserService::getUserInfoByOpenid($wxUserBaseInfo['openid']);
        }
        UserService::setUserInfoCookie($userInfo);
        $this->redirect('index/Index/index');
    }

}