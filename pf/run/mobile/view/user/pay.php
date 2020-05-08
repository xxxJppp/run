<?php
use xh\unity\cog;
use xh\library\url;

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>余额充值</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
  <link href="/static/Theme/css/trade.css" rel="stylesheet">
</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">余额充值</div>
</header>

<section class="container">
  
  <div class="digital-balance">
		<div class="digital-balance-current">
			<span>余额</span>
			<h3><?php echo $_SESSION['MEMBER']['balance'];?></h3>
		</div>
		
	
	</div>

  
  
	<div class="setting-form">
		<div class="form-widget">
			 <form id="from">

               <input disabled value="<?php echo $_SESSION['MEMBER']['uid'];?>" id="disabled" type="hidden" >
              
				<div class="form-box">
					
                  
                    <div class="form-group">
						<label class="form-label">充值余额;</label>

						<div class="form-control">
                            <select id="type" style="font-size:20px">
                      <option value="" disabled selected>请选择一个支付方式</option>
                       <option value="3">支付宝/微信转卡</option>
                      <option value="1" selected>微信支付</option>
                      <option value="2">支付宝支付</option>
                    </select>
                   
						</div>
					</div>
              
             
                              
                    <div class="form-group">
						<label class="form-label">充值余额;</label>

						<div class="form-control">
                            <input placeholder="请输入需要充值的金额" id="money" name="money" type="text" value="">
						</div>
					</div>
				
				<div class="form-submit">
                  
                    <a  class="form-submit-btn" onclick="payc();" >确认修改</a>
				</div>
			</form>
		</div>
	</div>
</section>
       <script type="text/javascript" src="http://xx.erinqak.cn/run/mobile/view//static/js/plugins/jquery-1.11.2.min.js"></script>  
  <script src="/static/js/layer/layer.js" type="text/javascript"></script>
  <script type="text/javascript">

      function payc(){
    	  window.open('<?php echo url::s("mobile/member/payResult");?>' + '?type=' + $('#type').val() +'&amount=' + $('#money').val());
		}

     
	  </script>
</body>
</html>
