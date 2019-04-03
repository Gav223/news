<?php
namespace app\index\service;

use app\common\model\User;
use think\facade\Cookie;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-3
 * Time: 下午4:13
 */
class UserService
{
    public static function getUserInfoByOpenid($openid)
    {
        return User::findOneByCondition(['openid' => $openid]);
    }

    public static function wxUserInfo2domain(array $wxUserInfo)
    {
        $domain = [];
        $domain['create_time'] = time();
        $domain['openid'] = $wxUserInfo['openid'];
        $domain['headimgurl'] = $wxUserInfo['headimgurl'];
        $domain['nickname'] = $wxUserInfo['nickname'];
        return $domain;
    }

    public static function insertUserInfo($domain)
    {
        return User::create($domain);
    }

    public static function setUserInfoCookie($userInfo)
    {
        Cookie::set('openid', $userInfo['openid']);
        Cookie::set('uid', $userInfo['id']);
        Cookie::set('userInfo', $userInfo);
    }
}