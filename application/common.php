<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function curl($url, $type, $param = null)
{

    $curl = curl_init();
    //设置提交的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if ($type === 'post') {
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        $post_data = $param;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    }
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    //获得数据并返回
    return $data;
}

function log4($message, $data = '', $reason = '', $type = 'info')
{
    if (is_array($data)) $data = json_encode($data);
    \think\facade\Log::$type('message:{message}|data:{data}|reason:{reason}', [
        'message' => $message,
        'data' => $data,
        'reason' => $reason
    ]);
}

//应用公共常量
define('APP_ID', 'wx985089ba7e56c17d');
define('APP_SECRET', '7ca46d683ac1ca57909447838b0a697b');
define('WX_GET_USER_INFO_API_PATH', "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APP_ID."&redirect_uri=".urlencode('http://news.leephp.cn/wxAuthCallBack')."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
define('DEFAULT_SHOW_NUM', 5);