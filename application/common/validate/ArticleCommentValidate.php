<?php
namespace app\common\validate;

use think\Validate;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-4
 * Time: 上午10:11
 */
class ArticleCommentValidate extends Validate
{
    protected $rule =   [
        'article_id'   => 'require',
        'content' => 'require|length:3-15'
    ];

    protected $message  =   [
        'article_id.require' => '请针对某条新闻评论',
        'content.require' => '说点什么吧...',
        'content.length' => '评论内容要在3-15字之间哦'
    ];

    protected $scene = [
        'insert'  =>  ['article_id', 'content']
    ];
}