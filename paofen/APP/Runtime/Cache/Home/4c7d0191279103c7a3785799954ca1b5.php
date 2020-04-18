<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>分享好友</title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js" ></script>

<body class="bg96 bg_blue"  style="background:#1f253d;">
	<div class="header" style="background:#1f253d;">
	    <div class="header_l" style="width:33.3%;">
			<a href="javascript:history.go(-1)"><img src="/Public/home/wap/images/jiant.png" alt=""  style="width:15%;"></a>
	    </div>
	    <div class="header_c" style="width:33.3%;"><h2  style="font-size:14px;">分享好友</h2></div>
	</div>
     <div class="big_width80">
	     <div class="qrCodeGro qrCodeGroa" style="margin-top: 80px;">
	     	<img src="<?php echo ($urel); ?>">
	     	<p class="mt40" style="font-size:12px;color:#ffffff;">扫描二维码即可分享好友哟</p>
	     </div>

	     <div class="fxfuzanj" style="margin-top:0px;">
             <span hidden id="txt"><?php echo ($aurl); ?></span>
             <a href="javascript:void(0)"  onclick="copyUrl();" style="text-decoration:none;font-size:12px;">复制推广链接 - &#36164;&#28304;&#36716;&#36733;&#26469;&#33258;&#87;&#87;&#87;&#46;&#80;&#72;&#80;&#56;&#53;&#46;&#67;&#79;&#77;</a>
         </div>

	</div>
    <script type="text/javascript">
        function copyUrl()
        {
            var txt=$("#txt").text();
            copy(txt);
        }

        function copy(message) {
            var input = document.createElement("input");
            input.value = message;
            document.body.appendChild(input);
            input.select();
            input.setSelectionRange(0, input.value.length), document.execCommand('Copy');
            document.body.removeChild(input);
            msg_alert("复制成功");
        }
    </script>

</body>
</html>