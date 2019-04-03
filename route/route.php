<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('personal', 'index/Personal/index');

Route::get('wxAuthCallBack', 'index/Wx/wxAuthCallBack');

Route::get('releaseArticle', 'index/ArticleValidate/releaseArticle');

Route::get('uploadImage', 'index/Upload/uploadImage');

Route::get('wxApiConfig', 'index/Wx/apiConfig');
return [

];
