<?php
namespace app\common\model;

use think\Model;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-3
 * Time: 下午2:30
 */
class Base extends Model
{
    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public static function findCountByCondition(array $condition = [])
    {
        $count = self::where($condition)->count();
        if ($count == false || $count == null || empty($count)) $count = 0;
        return $count;
    }

    public static function findByCondition(array $condition = [], $field = '', array $sort = ['id' => 'desc'])
    {
        return self::where($condition)->field($field)->order($sort)->select();
    }

    public static function findOneByCondition(array $condition = [], $field = '', array $sort = ['id' => 'desc'])
    {
        return self::where($condition)->field($field)->order($sort)->find();
    }

    public static function findAll(array $sort = ['id' => 'desc'], $field = '')
    {
        return self::order($sort)->field($field)->select();
    }
}