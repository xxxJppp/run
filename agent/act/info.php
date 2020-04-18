<?php 

$id = $_REQUEST['id']+0;

if ($id <= 0) {
	
   $e = 1;
}

$info = $mysql->select('fafa_renwu_list','*','id='.$id);


if ($info['uid'] != $_SESSION['h_id']) {
   
   exit('网络错误，请关闭此窗口重新尝试提交。');
}

$im = explode('|',$info['zhengju']);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
   <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
   <meta content="yes" name="apple-mobile-web-app-capable"/>
   <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
   <meta content="telephone=no" name="format-detection"/>
   <link rel="stylesheet" href="./public/ui/layui/css/layui.css"  media="all">
     <script src="<?=ROOT_PATH?>public/js/jquery.js"></script>
</head>
<body>
<div style="padding:5px;">
	

<form class="layui-form layui-form-pane" id="info">
  
  <div class="layui-form-item">
    <label class="layui-form-label">提交说明</label>
    <div class="layui-input-inline">
      <input type="text" name="t" lay-verify="required"  value="<?=$info['title']==''?'':$info['title']?>" placeholder="选填" autocomplete="off" class="layui-input">
    </div>
  </div>
  
  
  
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">任务信息</label>
    <div class="layui-input-block">
         <textarea class="layui-textarea" name="ins"  id="ins"><?=$info['txt']==''?'':$info['txt']?></textarea>
    </div>
  </div>
  <div class="layui-upload-drag" id="test2" style="width:99%; height:78px; padding:0 ; line-height: 78px;">
	  <i class="layui-icon" style="40px"></i>
	  <p>点击上传，或将文件拖拽到此处</p>
	</div>
  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
    预览图：
    <?php if ($info['zt']!=0): ?>
      <?php foreach ($im as $k => $v): ?>
        <div class="layui-upload-list" id="demo2">
          <img src="<?=$v?>"  class="layui-upload-img">
          <input type='hidden' name='im[]' value='<?=$v?>'>
        </div>
        <?php endforeach ?>
        <?php else: ?>
        <div class="layui-upload-list" id="demo2"></div>
        <?php endif ?>
    <span style="display:none" id="ims">
      
    </span>


 </blockquote>
 <input type="hidden" name="id" value="<?=$id?>">

 <?php if (!empty($info) && $info['zt'] == 2 ): ?>

 <?php elseif (!empty($info) && $info['zt'] == 3 ): ?>

  <div class="layui-form-item">
     <button class="layui-btn" type="button" id="save"  lay-filter="demo2">重新提交审核</button>
   </div>

 <?php elseif ($info['zt'] == 1 ): ?>
   <div class="layui-form-item">
     <button class="layui-btn" type="button" id="save"  lay-filter="demo2">修改审核</button>
   </div>
 <?php elseif ($info['zt'] == 0 ): ?>
   <div class="layui-form-item">
     <button class="layui-btn"  type="button" id="save" lay-filter="demo2">提交审核</button>
   </div>
 <?php endif ?>
  
</form>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px; ">
  <legend style="font-size:13px;">提交证据需按照下面要求</legend>
</fieldset>

<?php echo $mysql->select('fafa_renwu','shenhe','id='.$info['renwu_id']); ?>
<div>
	

</div>
</div>
<script src="./public/ui/layui/layui.js"></script> 

<script>
	
layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;
  
  //普通图片上传
  //多图片上传
  upload.render({
    elem: '#test2'
    ,url: 'up.dos'
    ,multiple: true
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
      });
    }
    ,done: function(res){
         
        $("#ims").append(" <input type='hidden' name='im[]' value='"+res.root+"''>");
    }
  });
  
  
  
});


</script>
  <script>
       $(document).ready(function(){
           $("#save").click(function(){
               var n = $("#im").val();
               var ins = $("#ins").val();
             
               if (n == '') {
                   layer.msg('截图凭据不能为空',{icon: 17,time: 3000,shade : [0.5 , '#000' , true]});
                   return false;
               };
               if (ins  == '') {
                   layer.msg('请按照下面要请，填写任务信息',{icon: 17,time: 3000,shade : [0.5 , '#000' , true]});
                   return false;
               };
              
               var data = $("#info").serialize();
               $.ajax({
                    type:"POST",
                    url:"index?act=infos",
                    data:data,
                    dataType:'json',
                    success:function(data){
                        if(data.error == 0){
                            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                            parent.layer.close(index);  // 关闭layer 
                        }else{

                            layer.msg(data.msg, {icon: 17,time: 3000,shade : [0.5 , '#000' , true]});
                        }
                    }
                });
           });
       })
    </script> 
</body>
</html>