<?php
namespace app\index\service;

use app\common\model\User;
use think\Cookie;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-3
 * Time: 下午4:13
 */
class UserService
{
    public function getUserInfoByOpenid($openid)
    {
        return User::findOneByCondition(['openid' => $openid]);
    }

    public function wxUserInfo2domain(array $wxUserInfo)
    {
        $domain = [];
        $domain['create_time'] = time();
        $domain['openid'] = $wxUserInfo['openid'];
        $domain['headimgurl'] = $wxUserInfo['headimgurl'];
        $domain['nickname'] = $wxUserInfo['nickname'];
        return $domain;
    }

    public function insertUserInfo($domain)
    {
        return User::create($domain);
    }

    public function setUserInfoCookie($userInfo)
    {
        Cookie::set('openid', $userInfo['openid']);
        Cookie::set('uid', $userInfo['id']);
        Cookie::set('userInfo', $userInfo);
    }
}