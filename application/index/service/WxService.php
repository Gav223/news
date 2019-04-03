<?php
namespace app\index\service;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-3
 * Time: 下午3:48
 */
class WxService
{

    /**
     * 生成加密签名
     * @param $timestamp
     * @param $nonce
     * @return string
     */
    public static function getSignature($timestamp, $nonce)
    {
        $token = WX_API_CONFIG_TOKEN;
        $dataArr = array($token, $timestamp, $nonce);
        sort($dataArr);
        $dataString = implode($dataArr);
        $signature = sha1($dataString);
        return $signature;
    }

    /**
     *
     * @param $code
     * @return array
     */
    public static function getAccessTokeParamArray($code)
    {
        return [
            'appid' => APP_ID,
            'secret' => APP_SECRET,
            'code' => $code,
            'grant_type' => 'authorization_code'
        ];
    }

    public static function getUserBaseInfo($code)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        $reqParam = self::getAccessTokeParamArray($code);
        $result = curl($url, 'post', $reqParam);
        $result = json_decode($result, true);
        return $result;
    }

    public static function getUserInfo($accessToken, $openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openid}&lang=zh_CN";
        $result = curl($url, 'get');
        $result = json_decode($result, true);
        return $result;
    }
}
