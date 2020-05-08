<?php
use xh\library\url;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>添加账号</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
 <script src="/static//js/llqrcode.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/analyticCode.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
  		<style type="text/css">
		
			.module-content{
				min-width: 770px;
				max-width: 1000px;
				width: 100%;
				color: #000;
				margin: 0 auto;
			}
			.module-head{
				text-align: center;
				font-weight: 500;
				margin: 0;
				font-size: 30px;
				height: 100px;
				line-height: 100px;
				color: #000;
			}
			.box h3{
				font-weight: 300;
				margin: 0;
				font-size: 20px;
				height: 60px;
				line-height: 60px;
				color: #000;
			}
			.url-box{
				height: 30px;
				line-height: 30px;
				font-size: 14px;
			}
			#file{
				position: absolute;
				width: 120px;
				height: 120px;
				opacity: 0;
				top: 0;
				left: 0;
				overflow: hidden;
				z-index: 10;
			}
		</style>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">添加账号（支付宝固码）</div>
</header>

<section class="container">
	<div class="setting-form">
		<div class="form-widget">

				<div class="form-box">
					<div class="form-group">
						<label class="form-label">上传二维码</label>

						<div class="form-control">
							<div class="box">
				<div style="position: relative;">
				
                     <img id="avatar" onclick="imgSelect();" style="width: 100px;border-radius:50%;margin: 0 auto;margin-top:15px" alt="/static/js/upload.png" src="/static/js/upload.png"></td>
                  <input type="file" name="avatar" id="avatarImg"  style="display:none;" onchange="uploadPic();">
                  
					<p class="url-box" id="urlBox"></p>
				</div>
			</div>
                          
                 
                          

						</div>
					</div>

					<div class="form-group">
						<label class="form-label">二维码解析</label>

						<div class="form-control">
							<input type="text" name="ewmjiexi" id="ewmjiexi" value="" placeholder="上传二维码自动解析">
						</div>
                     
					</div>
                       <p style="color:red;padding:6px">*上传二维码等10秒左右自动解析二维码</p>
                       <p style="color:red;padding:6px">*如果解析失败 请修改图片大小再上传</p>
                     <p style="color:red;padding:6px">*苹果手机不能自动解析 请手动解析 <a target="_blank" href="https://jiema.wwei.cn/">点击这里手动解析</a></p>
				</div>
				
              <div class="form-group">
						<label class="form-label">备注</label>

						<div class="form-control">
							<input type="text" name="name" id="name" value="" placeholder="请填写备注">
						</div>
					</div>
				</div>
				

				<div class="form-submit">
					<button type="submit" class="form-submit-btn" onclick="add()">确定</button>
				</div>
	
		</div>
	</div>
</section>
  <script src="/static/Theme/js/jquery-1.11.2.min.js"></script>
  <script src="/static/js/layer/layer.js" type="text/javascript"></script>

 <script type="text/javascript">
	function getUrl(e,param){
				analyticCode.getUrl(param,e,function(url1,url2){
					e.nextElementSibling.innerHTML = url1;
					e.previousElementSibling.src = url2;
				});
			}
   
    //选择头像
	function imgSelect(){
	        document.getElementById('avatarImg').click(); 
	}
   //上传头像
	function uploadPic(){
	    var pic = $('#avatarImg')[0].files[0];
	    var fd = new FormData();
	    fd.append('avatar', pic);
	    $.ajax({
	        url:"<?php echo url::s('mobile/paofen/jiexiup','id=' . $result['id']);?>",
	        type:"post",
	        // Form数据
	        data: fd,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success:function(data){
	            if(data.code == '200'){

                   layer.msg(data.msg, {icon: 1});
	         
                   document.getElementById("ewmjiexi").value = data.data.img;
	            }else{
                   layer.msg(data.msg, {icon: 2});
	            }
	        }
	    });
	                    
	}
   
      function add(){
         var ewm_url = $('#ewmjiexi').val();
        var name = $('#name').val();
			$.ajax({
		          type: "GET",
		          dataType: "json",
		          url: "<?php echo url::s('mobile/paofen/automaticAdd',"name=");?>" + name  +'&ewm_url='+ ewm_url+'&type=1',
		          data: $('#from').serialize(),
		          success: function (data) {
                    
		              if(data.code == '200'){
                        
                        layer.msg(data.msg,{
                            icon: 1,
                            time:1000,
                            end:function () {
                           location.href="/mobile/paofen/automatic.do";
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

		</script>

</body>
</html>
