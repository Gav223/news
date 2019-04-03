<?php
namespace app\index\behavior;

use think\Cookie;
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

    public function run()
    {
        if (Cookie::has('openid') === false) {
            $this->redirect(WX_GET_USER_INFO_API_PATH);
        }
    }
}