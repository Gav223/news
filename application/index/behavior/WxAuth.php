<?php
namespace app\index\behavior;

use think\facade\Cookie;
use think\Request;
use traits\controller\Jump;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-3
 * Time: 下午3:55
 */
class WxAuth
{
    use Jump;

    /**
     * 鉴权(如果cookie中没有openid就去授权
     * @param Request $request
     */
    public function run(Request $request)
    {
        $action = $request->action(true);
        if (Cookie::has('openid') === false && $action !== 'wxAuthCallBack') {
            $this->redirect(WX_GET_USER_INFO_API_PATH);
        }
    }
}