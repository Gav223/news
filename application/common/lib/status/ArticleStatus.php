<?php
namespace app\common\lib\status;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-1
 * Time: 下午8:35
 */
class ArticleStatus
{
    public static $WAIT_TO_CHECK = 'WAIT_TO_CHECK'; //待审核
    public static $NORMAL = 'NORMAL';   //正常
    public static $SOLD_OUT = 'SOLD_OUT';   //下架
    public static $DELETE = 'DELETE';   //删除
}