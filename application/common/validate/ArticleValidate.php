<?php
namespace app\common\validate;

use think\Validate;

/**
 * Created by PhpStorm.
 * User: admin123
 * Date: 19-4-3
 * Time: 上午10:40
 */
class ArticleValidate extends Validate
{
    protected $rule =   [
        'title|新闻标题'   => 'require|length:5,15',
        'description|新闻简介' => 'require|length:30,50',
        'image_url|新闻图片' => 'require'
    ];

    protected $message  =   [
        'title.length' => '新闻标题长度必须在5-15字之间',
        'description.length' => '新闻描述长度必须在30-100字之间'
    ];

    protected $scene = [
        'insert'  =>  ['title', 'description', 'image_url'],
    ];
}