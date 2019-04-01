<?php

namespace app\index\service;
use app\index\model\User;
use think\facade\Cookie;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 3/14/19
 * Time: 10:42 PM
 */

class IndexService
{

    /**
     * 生成加密签名
     */
    public function getSignature($timestamp, $nonce)
    {
        $token = 123;
        $dataArr = array($token, $timestamp, $nonce);
        sort($dataArr);
        $dataString = implode($dataArr);
        $signature = sha1($dataString);
        return $signature;
    }

    public function getAccessTokeParamArray($code)
    {
        $appid = 'wx985089ba7e56c17d';
        $appSecret = '7ca46d683ac1ca57909447838b0a697b';
        $retArray = [
            'appid' => $appid,
            'secret' => $appSecret,
            'code' => $code,
            'grant_type' => 'authorization_code'
        ];
        return $retArray;
    }

    public function getUserBaseInfo($code)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        $reqParam = $this->getAccessTokeParamArray($code);
        $result = curl($url, 'post', $reqParam);
        $result = json_decode($result, true);
        return $result;
    }

    public function getUserInfo($accessToken, $openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openid}&lang=zh_CN";
        $result = curl($url, 'get');
        $result = json_decode($result, true);
        return $result;
    }

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
        return User::insert($domain);
    }

    public function setUserInfoCookie($userInfo)
    {
        Cookie::set('openid', $userInfo['openid']);
        Cookie::set('userInfo', $userInfo);
    }
}