<?php
namespace app\index\model;

use think\Model;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 3/17/19
 * Time: 7:31 PM
 */
class User extends Model
{
    public static function findByCondition(array $condition)
    {
        return self::where($condition)->all();
    }

    public static function findOneByCondition(array $condition)
    {
        return self::where($condition)->find();
    }
}