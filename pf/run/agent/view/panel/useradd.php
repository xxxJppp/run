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
  
  <script src="/run/index/view/static/js/assset/ace-extra.min.js"></script>
<script src="/run/index/view/static/js/assset/jquery-1.9.1.min.js"></script>
<script src="/run/index/view/static/js/assset/bootstrap.min.js"></script>
<script src="/run/index/view/static/js/assset/typeahead-bs2.min.js"></script>
<script src="/run/index/view/static/js/assset/ace-elements.min.js"></script>
<script src="/run/index/view/static/js/assset/ace.min.js"></script>
<script src="/run/index/view/static/js/assset/layer.js" type="text/javascript"></script>
<script src="/run/index/view/static/js/assset/laydate.js" type="text/javascript"></script>
    <link rel="icon" href="<?php echo URL_ROOT;?>/favicon.ico" />
</head>
<body>
    <!-- START CONTENT -->
      <section id="content">
<style>
.radio {
  margin: 0.5rem;
}
.radio input[type="radio"] {
  position: absolute;
  opacity: 0;
}
.radio input[type="radio"] + .radio-label:before {
  content: '';
  background: #f4f4f4;
  border-radius: 100%;
  border: 1px solid #b4b4b4;
  display: inline-block;
  width: 1.4em;
  height: 1.4em;
  position: relative;
  top: -0.2em;
  margin-right: 1em;
  vertical-align: top;
  cursor: pointer;
  text-align: center;
  -webkit-transition: all 250ms ease;
  transition: all 250ms ease;
}
.radio input[type="radio"]:checked + .radio-label:before {
  background-color: #3197EE;
  box-shadow: inset 0 0 0 4px #f4f4f4;
}
.radio input[type="radio"]:focus + .radio-label:before {
  outline: none;
  border-color: #3197EE;
}
.radio input[type="radio"]:disabled + .radio-label:before {
  box-shadow: inset 0 0 0 4px #f4f4f4;
  border-color: #b4b4b4;
  background: #b4b4b4;
}
.radio input[type="radio"] + .radio-label:empty:before {
  margin-right: 0;
}
        </style>

        <!--start container-->
        <div class="container">

                <div class="col s12 m12 l12" style="margin-top: 60px;">
                  <div class="row">
                    <form class="col s12" id="from">
                    
              
                          <input disabled value="<?php echo $_SESSION['MEMBER']['key_id'];?>" id="disabled" type="hidden" class="validate">
                        <input placeholder="手机号码" id="phone" name="phone" type="hidden" class="validate" value="<?php echo $_SESSION['MEMBER']['phone'];?>">
                        
                    
                   
                      
                      <div class="row">
                         <div class="input-field col s6">
                          <input placeholder="请输入用户名" name="username" id="username" type="text" class="validate">
                          <label for="username">用户名</label>
                        </div>
                      </div>
                      
                       <div class="row">
                         <div class="input-field col s6">
                          <input placeholder="请输入手机号" name="phone" id="phone" type="text" class="validate">
                          <label for="phone">手机号</label>
                        </div>
                      </div>
                      
                        <div class="row">
                         <div class="input-field col s6">
                          <input placeholder="请输入密码" name="pwd" id="pwd" type="text" class="validate">
                          <label for="pwd">密码</label>
                        </div>
                      </div>
<!--

                                    <div class="radio">
                  <input id="radio-1" name="is_mashang" type="radio" value="0" checked>
                  <label for="radio-1" class="radio-label">商户</label>
                </div>-->

               <!-- <div class="radio">
                  <input id="radio-2" name="is_mashang" type="radio" value="1" checked>
                  <label  for="radio-2" class="radio-label">码商</label>
                </div>-->

                 
                      
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

        function myrefresh()
          {
             window.location.reload();
          }

        
        
      function edit(){
			$.ajax({
		          type: "POST",
		          dataType: "json",
		          url: "<?php echo url::s('agent/panel/userddsave');?>",
		          data: $('#from').serialize(),
		          success: function (data) {
		              if(data.code == '200'){
		            	  layer.msg(data.msg, {icon: 1});
                         setTimeout('myrefresh()',3000); 
		              }else{
		            	  layer.msg(data.msg, {icon: 2});
                         setTimeout('myrefresh()',3000); 
		              }
		          },
		          error: function(data) {
		              alert("error:"+data.responseText);
                    
		           }
		  });
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
   
   