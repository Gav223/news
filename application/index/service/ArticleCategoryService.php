<?php
namespace app\index\service;

use app\common\model\ArticleCategory;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-4
 * Time: 上午11:35
 */
class ArticleCategoryService
{

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