<?php
use xh\unity\cog;
use xh\library\url;

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>申请提现</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
  <link href="/static/Theme/css/trade.css" rel="stylesheet">
</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">申请提现</div>
</header>

<section class="container">
  
  <div class="digital-balance">
		<div class="digital-balance-current">
			<span>可提现金额</span>
			<h3><?php echo $_SESSION['MEMBER']['balance'];?></h3>
		</div>
		
	
	</div>

  
  
	<div class="setting-form">
		<div class="form-widget">
			 <form id="from">
              
                <input disabled value="<?php echo $_SESSION['MEMBER']['key_id'];?>" id="disabled" type="hidden" class="validate">
                        <input placeholder="手机号码" id="phone" name="phone" type="hidden" class="validate" value="<?php echo $_SESSION['MEMBER']['phone'];?>">
              
              
				<div class="form-box">
					
              
                   <?php if ($_SESSION['MEMBER']['bank']['type'] == 1){?>

              <div class="form-group">
						<label class="form-label">真实姓名：</label>

						<div class="form-control">
							<input type="text"  value="<?php echo $_SESSION['MEMBER']['bank']['name'];?>" disabled>
						</div>
					</div>
              
              <div class="form-group">
						<label class="form-label">支付宝账号:</label>

						<div class="form-control">
							<input type="text" placeholder="支付宝账号" value="<?php echo $_SESSION['MEMBER']['bank']['card'];?>" disabled>
						</div>
					</div>
         <?php }?>
              
              
                <?php if ($_SESSION['MEMBER']['bank']['type'] == 2){?>
              
              <div class="form-group">
						<label class="form-label">真实姓名：</label>

						<div class="form-control">
							<input type="text" placeholder="真实姓名" value="<?php echo $_SESSION['MEMBER']['bank']['name'];?>" disabled>
						</div>
					</div>
              
              <div class="form-group">
						<label class="form-label">银行名称：</label>

						<div class="form-control">
							<input type="text" placeholder="请输入银行名称" value="<?php echo $_SESSION['MEMBER']['bank']['bank'];?>" disabled>
						</div>
					</div>
                  
                  
                    <div class="form-group">
						<label class="form-label">银行卡号;</label>

						<div class="form-control">
							<input type="text" placeholder="银行卡号" value="<?php echo $_SESSION['MEMBER']['bank']['bank'];?>" disabled >
						</div>
					</div>
              
              <?php }?>
              
                    <div class="form-group">
						<label class="form-label">提现余额;</label>

						<div class="form-control">
							<input type="text" placeholder="请输入需要提现的金额" id="amount" name="amount" type="text" value="" >
						</div>
					</div>
				
				<div class="form-submit">
                  
                    <a  class="form-submit-btn" onclick="apply();" >确认修改</a>
				</div>
			</form>
		</div>
	</div>
</section>
       <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jquery-1.11.2.min.js"></script>  
  <script src="/static/js/layer/layer.js" type="text/javascript"></script>
 <script type="text/javascript">


   
     function apply(){
			$.ajax({
		          type: "POST",
		          dataType: "json",
		          url: "<?php echo url::s('mobile/member/applyWithdrawResult');?>",
		          data: $('#from').serialize(),
		          success: function (data) {
		              if(data.code == '200'){
                        
		            	  layer.msg(data.msg,{
                            icon: 1,
                            time:1000,
                            end:function () {
                          location.href="/mobile/member/withdraw";
                            }
                        })
                        
		              }else{
		            	  if(data.code == "-39"){

				          }
			              if(data.code == "-89"){
			            	 
				          }
		            	  layer.msg(data.msg, {icon: 2});
		              }
		          },
		          error: function(data) {
		              alert("error:"+data.responseText);
		           }
		  });
		}
    
  </script>
</body>
</html>
