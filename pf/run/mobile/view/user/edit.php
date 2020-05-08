<?php
use xh\library\url;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>修改资料</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">修改资料</div>
</header>

<section class="container">
	<div class="setting-form">
		<div class="form-widget">
			 <form id="from">
              
                <input disabled value="<?php echo $_SESSION['MEMBER']['key_id'];?>" id="disabled" type="hidden" class="validate">
                        <input placeholder="手机号码" id="phone" name="phone" type="hidden" class="validate" value="<?php echo $_SESSION['MEMBER']['phone'];?>">
              
              
				<div class="form-box">
					<div class="form-group">
						<label class="form-label">新密码：</label>

						<div class="form-control">
							<input type="password" name="pwd" id="pwd" placeholder="不修改密码请留空">
						</div>
					</div>
					
					<div class="form-group">
						<label class="form-label">提现类型：</label>

						<div class="form-control">
							  <select name="bank_type" onchange="bank_show(this.value)" style="font-size: 18px;">
                      <option value="" disabled selected>请选择一个提现方式</option>
                      <option value="1">支付宝</option>
                      <option value="2">银行卡</option>
                      <option value="3">暂不填写</option>
                    </select>
						</div>
					</div>
				</div>
				
              
               <div style="display: none;" id="bank_a">
              
              <div class="form-group">
						<label class="form-label">真实姓名：</label>

						<div class="form-control">
							<input type="text" placeholder="真实姓名" name="alipay_name">
						</div>
					</div>
              
              <div class="form-group">
						<label class="form-label">支付宝账号:</label>

						<div class="form-control">
							<input type="text" placeholder="支付宝账号" name="alipay_content">
						</div>
					</div>
              
               </div>
              
              
                <div style="display: none;" id="bank_b">
              
              <div class="form-group">
						<label class="form-label">真实姓名：</label>

						<div class="form-control">
							<input type="text" placeholder="真实姓名" name="bank_name">
						</div>
					</div>
              
              <div class="form-group">
						<label class="form-label">银行名称：</label>

						<div class="form-control">
							<input type="text" placeholder="请输入银行名称" name="bank" type="text" value="">
						</div>
					</div>
                  
                  
                    <div class="form-group">
						<label class="form-label">银行卡号;</label>

						<div class="form-control">
							<input type="text" placeholder="银行卡号" name="card" >
						</div>
					</div>
              
               </div>
              
              
				
				<div class="form-submit">
                  
                    <a  class="form-submit-btn" onclick="edit();" >确认修改</a>
				</div>
			</form>
		</div>
	</div>
</section>
       <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jquery-1.11.2.min.js"></script>  
  <script src="/static/js/layer/layer.js" type="text/javascript"></script>
 <script type="text/javascript">

      function edit(){
			$.ajax({
		          type: "POST",
		          dataType: "json",
		          url: "<?php echo url::s('mobile/member/editResult');?>",
		          data: $('#from').serialize(),
		          success: function (data) {
		              if(data.code == '200'){
                        
                        layer.msg(data.msg,{
                            icon: 1,
                            time:1000,
                            end:function () {
                           location.href="/mobile/panel/my";
                            }
                        })
        
		              }else{
		            	  layer.msg(data.msg, {icon: 2});
		              }
		          },
		          error: function(data) {
		              alert("error:"+data.responseText);
		           }
		  });
		}
     function bank_show(type){
		if(type == 1){
			$('#bank_a').show();
			$('#bank_b').hide();
		}
		if(type == 2){
			$('#bank_a').hide();
			$('#bank_b').show();
		}
		if(type == 3){
			$('#bank_a').hide();
			$('#bank_b').hide();
		}
      }
    
  </script>
</body>
</html>
