<?php
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
use xh\unity\userCog;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
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
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/dropify/css/dropify.min.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>
<body>
      <!-- START CONTENT -->
      <section id="content">


        <!--start container-->
        <div class="container">
          <div class="section">

            <!--Input Select-->
            <div class="section">
            
              <div id="input-select" class="row" >
         
             
                
                <div class="col s12 m8 l9" style="width:100%">
                  <div class="input-field col s12">
                    <label style="margin-bottom:10px;font-size:16px">请上传微信赞赏二维码 </br></label>
                    <div class="row section" style="margin-top: 30px;">
              		<div class="col s12 m8 l9" style="width:66%">
                  		<input type="file" id="input-file-now" class="dropify" data-default-file="" />
              		</div>
            	</div>
                  </div>
                </div>
                
                
                
                <div class="box">
				<img onClick="getUrl(this,'img-url')" id="photo" src="" width="60" style="display:none"/>
				 <input type="hidden" name="ewmjiexi" id="ewmurl" value="">
			</div>
                
                 <div class="col s12 m8 l9" style="margin-top:30px;">
                  <div class="input-field col s12">
                    <label>备注</label>
                    <input type="text" name="name" id="name" value="" placeholder="请输入备注" />
                  </div>
				 
                </div>
                
                <div class="col s12 m8 l9">
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light" id="addBtn" type="submit" onclick="add();">确认添加</button>
                      </div>
                </div>
              </div>
            </div>

        </div>

    </div>
  <!--end container-->

  </section>
  <!-- END CONTENT -->
  

  <?php include_once (PATH_VIEW . 'common/footer.php');?>    
  <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/dropify/js/dropify.min.js"></script>
   <script src="/js/llqrcode.js" type="text/javascript" charset="utf-8"></script>
		<script src="/js/analyticCode.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    
function getUrl(e,param){
				analyticCode.getUrl(param,e,function(url1,url2){
					e.nextElementSibling.innerHTML = url1;
					e.previousElementSibling.src = url2;
				});
			}
    
    
    
  function add(){
	    $('#addBtn').attr('disabled',true);
	    $('#addBtn').text('请稍后..');
		var fileObj = document.getElementById("input-file-now").files[0]; // js 获取文件对象
		var formFile = new FormData();
		formFile.append("name", $('#name').val());


    	formFile.append("ewmurl", fileObj); //加入文件对象
    	var data = formFile; //$('#from').serialize()
		$.ajax({
	          type: "POST",
	          dataType: "json",
	          url: "<?php echo url::s('index/wechatzs/add');?>",
	          data: data,
          cache: false,//上传文件无需缓存
          processData: false,//用于对data参数进行序列化处理 这里必须false
          contentType: false, //必须
	          success: function (data) {
	              if(data.code == '200'){
	            	  swal("操作提示", data.msg, "success");
	            	  setTimeout(function(){parent.location.reload();},1500);
	              }else{
	            	  $('#addBtn').attr('disabled',false);
	            	  $('#addBtn').text('确认添加');
	            	  swal("操作提示", data.msg, "error");
	              }
	          }
	  	});
		}

        $(document).ready(function(){
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove:  'Supprimer',
                    error:   'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('.dropify-event').dropify();

            drEvent.on('dropify.beforeClear', function(event, element){

                return confirm("Do you really want to delete \"" + element.filename + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element){
                alert('File deleted');
            });
        });
    </script>