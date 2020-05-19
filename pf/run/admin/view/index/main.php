<?php 
use xh\library\url;
use xh\unity\cog;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
?>
<div id="top" class="clearfix">

    <div class="applogo">
        <a href="<?php echo url::s('admin/index/home'); ?>" class="logo"><?php echo WEB_NAME; ?></a>
    </div>
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <ul class="top-right">
        <?php if (is_array($view_module)) {
            $view_module_num = count($view_module);
            ?>
            <li class="dropdown link">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle hdbutton">快捷操作 <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-list">
                    <?php for ($i = 0; $i < $view_module_num; $i++) { ?>
                        <li><a href="#"><i class="fa falist fa-paper-plane-o"></i>快捷访问1</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <li class="dropdown link">
            <a href="#" data-toggle="dropdown"
               class="dropdown-toggle profilebox"><b><?php echo $_SESSION['USER_MGT']['username']; ?></b><span
                        class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
                <li role="presentation" class="dropdown-header">个人</li>
                <li><a href="<?php echo url::s('admin/user/editView'); ?>"><i class="fa falist fa-wrench"></i>修改资料</a>
                </li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa falist fa-lock"></i> 锁定账户</a></li>
                <li><a href="<?php echo url::s('admin/user/out'); ?>"><i class="fa falist fa-power-off"></i> 安全注销</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<div class="content">
    <iframe style="width: 100%;height: 100%" id="content_html" src="" frameborder="0"></iframe>
</div>
<script type="text/javascript">
    $(function () {
        layui.use('element', function(){
            var element = layui.element;
        });
        $(".iframe_open").on('click',function () {
            var href = $(this).data('href');
            $(".content iframe").attr('src',href);
        })
    })

    function withdrawNotice() {
        $.get("<?php echo url::s('index/notice/polling');?>", function (result) {
            if (result.code == '200') {
                //提现通知
                playSound();
            }
        });
    }

    setInterval("withdrawNotice()", 2000);

    function playSound() {
        var borswer = window.navigator.userAgent.toLowerCase();
        if (borswer.indexOf("ie") >= 0) {
            //IE内核浏览器
            var strEmbed = '<embed name="embedPlay" src="<?php echo URL_STATIC . "media/withdraw111.mp3";?>" autostart="true" hidden="true" loop="false"></embed>';
            if ($("body").find("embed").length <= 0)
                $("body").append(strEmbed);
            var embed = document.embedPlay;

            //浏览器不支持 audion，则使用 embed 播放
            embed.volume = 100;
            //embed.play();
        } else {
            //非IE内核浏览器
            var strAudio = '<audio id="audioPlay" src="<?php echo URL_STATIC . "media/withdraw111.mp3";?>" hidden="true">';
            if ($("body").find("audio").length <= 0)
                $("body").append(strAudio);
            var audio = document.getElementById("audioPlay");

            //浏览器支持 audion
            audio.play();
        }
    }
</script>
