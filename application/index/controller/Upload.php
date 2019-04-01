<?php
namespace app\index\controller;

use app\common\lib\Code;
use app\common\lib\Message;
use think\Controller;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-1
 * Time: 下午10:46
 */
class Upload extends Controller
{
    /**
     * 图片上传
     */
    public function uploadImage()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->validate(['size'=>15678090,'ext'=>'jpg,png,gif,jpeg'])->move( './upload');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            return json(['code' => Code::$SUCCESS, 'message' => Message::$SUCCESS, 'data' => $info->getSaveName()]);
        }else{
            // 上传失败获取错误信息
            return json(['code' => Code::$FAIL, 'message' => Message::$FAIL, 'data' => $info->getErrot()]);
        }
    }
}