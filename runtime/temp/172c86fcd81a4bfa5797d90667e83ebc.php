<?php /*a:1:{s:58:"/www/wwwroot/news/application/index/view/news/release.html";i:1554048064;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="/static/index/css/amazeui.min.css">
    <link rel="stylesheet" href="/static/index/css/wap.css?2">
    <!-- 富文本 -->
    <!-- 引入jQuery -->
    <script src="/static/index/eleditor/jquery.min.js"></script>
    <script src="/static/index/eleditor/webuploader.min.js"></script>
    <!-- 插件核心 -->
    <script src="/static/index/eleditor/Eleditor.min.js"></script>
    <title>首页</title>
</head>
<body>
<form class="am-form" method="post" action="<?php echo url('/releaseNews'); ?>">
    <fieldset>
        <!--<legend>发布新闻</legend>-->

        <div class="am-form-group  am-input-sm">
            <label for="doc-ipt-email-1">文章类型</label>
            <div class="am-form-group am-form-select">
                <select class="am-input-sm">
                    <option value="">生活</option>
                </select>
            </div>
        </div>

        <div class="am-form-group  am-input-sm">
            <label for="doc-ipt-email-1">标题</label>
            <input type="text" class="am-input-sm" id="doc-ipt-email-1" placeholder="文章标题">
        </div>

        <div class="am-form-group  am-input-sm">
            <label for="doc-ta-1">简介</label>
            <textarea class="am-input-sm" rows="5" id="doc-ta-1" placeholder="文章简介"></textarea>
        </div>

        <div class="am-form-group  am-input-sm">
            <label for="doc-ta-1">文章展示图</label>
            <div class="am-form-group am-form-file">
                <!--<label for="doc-ipt-file-2">Amaze UI 文件上传域</label>-->
                <div>
                    <button type="button" class="am-btn am-btn-default am-btn-sm">
                        <i class="am-icon-cloud-upload"></i> 选择要上传的图片</button>
                </div>
                <input type="file" id="doc-ipt-file-2">
            </div>
        </div>
        <div class="am-form-group am-form-file am-input-sm">
            <label for="doc-ipt-file-2">文章内容</label>
        </div>
        <div id="contentEditor">
        </div>

        <p>
            <button type="submit" class="am-btn am-btn-primary am-btn-block">发布</button>
        </p>
    </fieldset>
</form>

<script src="/static/index/js/jquery.min.js"></script>
<script src="/static/index/js/amazeui.min.js"></script>
<script>
    $(function(){

        // 动态计算新闻列表文字样式
        auto_resize();
        $(window).resize(function() {
            auto_resize();
        });
        $('.am-list-thumb img').load(function(){
            auto_resize();
        });

        $('.am-list > li:last-child').css('border','none');
        function auto_resize(){
            $('.pet_list_one_nr').height($('.pet_list_one_img').height());

        }
        $('.pet_nav_gengduo').on('click',function(){
            $('.pet_more_list').addClass('pet_more_list_show');
        });
        $('.pet_more_close').on('click',function(){
            $('.pet_more_list').removeClass('pet_more_list_show');
        });
    });

    var contentEditor = new Eleditor({
        el: '#contentEditor',
        upload: {
            server: '/',
            formData: {
                'token': '123123'
            },
            compress: false,
            fileSizeLimit: 2
        }
    });

</script>

</body>
</html>