<?php
use xh\library\url;
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title><?php echo WEB_NAME; ?>-登录</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/login.css" rel="stylesheet">
</head>

<body>
<div class="login">
	

	
	<div class="login-form">
		<form id="profile">
			<h1 class="login-logo">
				<?php echo WEB_NAME; ?>
			</h1>
			
			<div class="login-form-group">
				<label class="icon-phone">账号</label>

				<div class="input-group">
					<input name="member_id" id="member_id" placeholder="请输入账号">
					<i class="clear-keyword"></i>
				</div>
			</div>
			
			<div class="login-form-group">
				<label class="icon-pw">登录密码</label>

				<div class="input-group">
					<input type="password" name="pwd" id="pwd" placeholder="请输入登录密码">
					<i class="clear-keyword"></i>
				</div>
			</div>
			
		
			
			<div class="login-submit">
				<button type="submit" lay-submit="" lay-filter="profile">登录</button>
			</div>
			
		
		</form>
	</div>
</div>


<script src="/static/Theme/js/jquery-1.11.2.min.js"></script>
<script>
	$(function(){
		$('.language-box').click(function(){
			$('.choose-lang').fadeIn();
		});
		
		$('.choose-lang').click(function(){
			 $(this).fadeOut();
		});
	});
</script>

   <script src="/static/Theme/js/jquery-1.11.2.min.js"></script>
  <script src="/static/js/layer/layer.js" type="text/javascript"></script>

 <script type="text/javascript">
	function getUrl(e,param){
				analyticCode.getUrl(param,e,function(url1,url2){
					e.nextElementSibling.innerHTML = url1;
					e.previousElementSibling.src = url2;
				});
			}
   


 <script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/bootstrap.min.js"></script>
<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Front/js/content.js"></script>
<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/Util.js" charset="utf-8"></script>
<script>
  layui.use(['laydate', 'laypage', 'layer', 'form', 'element'], function() {
        var laydate = layui.laydate //日期
            ,layer = layui.layer //弹层
            ,form = layui.form //弹层
            , element = layui.element; //元素操作
        //日期
        laydate.render({
            elem: '#date'
        });
        //监听提交
      
       form.on('submit(profile)', function(data){
           
            $.ajax({
            url:"<?php echo url::s('mobile/user/dologin');?>",
            type:"post",
            data:$('#profile').serialize(),
            success:function(res){
                if(res.code == '200'){
                    layer.msg(res.msg,{
                            icon: 1,
                            time:1000,
                            end:function () {
                         location.href="<?php echo url::s('mobile/panel/index');?>";
                            }
                        })
                }else{
                     layer.msg(res.msg, {icon: 2});
                }
            }
        });
            return false;
        });
    });
  
</script>
</body>
</html>