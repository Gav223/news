<?php
namespace app\index\service;

use app\common\model\Article;
use app\common\model\ArticleCategory;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-3
 * Time: 下午8:08
 */
class IndexService
{
    /**
     * 查询index操作返回数据
     * TODO 1.文章列表
     */
    public static function getIndexResParam()
    {
        $articleList = Article::findByCondition();
        return self::setCategoryName($articleList);
    }

    /**
     * 关联查询文章分类名
     * @param $articleList
     * @return mixed
     */
    public static function setCategoryName($articleList)
    {
        foreach ($articleList as $key => $value) {
            $category = ArticleCategory::findOneByCondition(['id' => $value['category_id']]);
            $articleList[$key]['category_name'] = $category['name'];
        }
        return $articleList;
    }
}