<?php
use xh\unity\cog;
use xh\library\url;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="<?php echo cog::web()['description'];?>">
    <meta name="keywords" content="<?php echo cog::web()['keywords'];?>">
    <title>Fast payment platform - <?php echo cog::web()['name'];?></title>
    <!-- CORE CSS-->    
    <link href="<?php echo URL_VIEW;?>/static/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="<?php echo URL_VIEW;?>/static/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
  
    <link rel="icon" href="<?php echo URL_ROOT;?>/favicon.ico" />
</head>
<body>
    <!-- START CONTENT -->
      <section id="content">


        <!--start container-->
        <div class="container">

                <div class="col s12 m12 l12" style="margin-top: 60px;">
                  <div class="row">
                    <form class="col s12" id="from">
                    
              
                          <input disabled value="<?php echo $_SESSION['MEMBER']['key_id'];?>" id="disabled" type="hidden" class="validate">
                        <input placeholder="手机号码" id="phone" name="phone" type="hidden" class="validate" value="<?php echo $_SESSION['MEMBER']['phone'];?>">
                        
                    
                   
                      
                      <div class="row">
                         <div class="input-field col s6">
                          <input placeholder="不修改密码请留空" name="pwd" id="pwd" type="text" class="validate">
                          <label for="pwd">密码</label>
                        </div>
                      </div>
                      
                       <div class="row" id="input-select">
                       
                       <div class="input-field col s6">
                       <label>银行卡</label>
                    <select name="bank_type" onchange="bank_show(this.value)">
                      <option value="" disabled selected>请选择一个提现方式</option>
                      <option value="1">支付宝</option>
                      <option value="2">银行卡</option>
                      <option value="3">暂不填写</option>
                    </select>
                  </div>
                      </div>
                      
                      <div class="row" style="display: none;" id="bank_a">
                         <div class="input-field col s3">
                          <input placeholder="真实姓名" name="alipay_name" type="text" class="validate">
                          <label>姓名</label>
                        </div>
                        <div class="input-field col s5">
                          <input placeholder="支付宝账号" name="alipay_content" type="text" class="validate">
                          <label>账号</label>
                        </div>
                      </div>
                      
                      <div class="row" style="display: none;" id="bank_b">
                         <div class="input-field col s3">
                          <input placeholder="真实姓名" name="bank_name" type="text" class="validate">
                          <label>姓名</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder="银行" name="bank" type="text" class="validate" value="工商银行">
                          <label>银行名称</label>
                        </div>
                        <div class="input-field col s5">
                          <input placeholder="银行卡号" name="card" type="text" class="validate">
                          <label>银行卡号</label>
                        </div>
                      </div>
                      
                      
                    
                    
                      
                       <div class="row"><div class="input-field col s4">
                       <a class="btn waves-effect waves-light teal" onclick="edit();" style="background-color: #5874c8 !important;">确认修改</a></div></div>
                      
                      
                    </form>
                    
                    
                  </div>
                </div>

        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->
      <script type="text/javascript">

      function edit(){
			$.ajax({
		          type: "POST",
		          dataType: "json",
		          url: "<?php echo url::s('pankou/member/editResult');?>",
		          data: $('#from').serialize(),
		          success: function (data) {
		              if(data.code == '200'){
		            	  layer.msg(data.msg, {icon: 1});
		              }else{
		            	  layer.msg(data.msg, {icon: 2});
		              }
		          },
		          error: function(data) {
		              alert("error:"+data.responseText);
		           }
		  });
		}

      //获取验证码
      function getCode(obj){
	  $.get("<?php echo url::s('agent/member/getCode');?>", function(result){
	       	 if(result.code == '200'){
		       	       settime($(obj));
		       		   layer.msg(result.msg, {icon: 1});

		              }else{
		               layer.msg(result.msg, {icon: 2});
		         }
	   		});
  }

      var countdown=90;
      
      function settime(obj) { //发送验证码倒计时
    	    if (countdown == 0) { 
    	        obj.attr('disabled',false); 
    	        //obj.removeattr("disabled"); 
    	        obj.text("重新获取");
    	        countdown = 60;
    	        return;
    	    } else { 
    	        obj.attr('disabled',true);
    	        obj.text("重新获取(" + countdown + ")");
    	        countdown--;
    	    } 
    	setTimeout(function() { 
    	    settime(obj) }
    	    ,1000);
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
       <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- chartist 
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartist-js/chartist.min.js"></script>   -->
    <!-- chartjs -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartjs/chart.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartjs/chart-script.js"></script> -->
    <!-- sparkline -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sparkline/sparkline-script.js"></script>
    <!--jvectormap-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/vectormap-script.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/custom-script.js"></script>
    <!-- Toast Notification -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.min.js"></script>  
    <!-- layer -->
    <script src="<?php echo URL_STATIC . 'js/layer/layer.js';?>" charset="utf-8"></script>
   
   