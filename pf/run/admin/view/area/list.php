<?php 
use xh\library\url;
use xh\library\model;
use xh\library\ip;
include_once (PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>

<!-- START CONTENT -->

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">地区管理</li>
      </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a data-toggle="modal" data-target="#add" class="btn btn-light">添加地区</a> 
        <a href="?verification=<?php echo mt_rand(1000,9999);?>" class="btn btn-light"><i class="fa fa-refresh"></i></a>
        <!--<a data-toggle="modal" data-target="#search" class="btn btn-light"><i class="fa fa-search"></i></a>-->
       
      </div>
    </div>
    <!-- End Page Header Right Div -->
  </div>
  <!-- End Page Header -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  <!-- Start Row -->
  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
               
                <td>名称</td>
                <td>状态</td>
                <td>操作  <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                      
                       
                    </div></td>
              </tr>
            </thead>
            <tbody>
            <?php  foreach ($group as $gp){?>
              <tr style="    width: 24%;">
                    <td style="    width: 24%;">
                <?php echo $gp['cityname'];?>

                </td>
              <td>
                <?php if($gp['type'] == 1){echo "启用";}else{ echo "关闭";};?>
                </td>
                
                <td>
              <p>
                <a href="<?php echo url::s('admin/area/edit',"id=" . $gp['id']);?>"  class="btn btn-default btn-xs"><i class="fa fa-edit"></i>修改</a>
               <a href="#" onclick="deletec('<?php echo $gp['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>删除</a></p>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
          
          <div style="float:right;">
          <?php (new model())->load('page', 'turn')->auto($member['info']['pageAll'], $member['info']['page'], 10); ?>
          </div>
          <div style="clear: both"></div>
          
        </div>

      </div>
    </div>
    <!-- End Panel -->
    
    
    <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
              <form class="form-horizontal" id="from" method="post" action="#">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加地区</h4>
                  </div>
                  <div class="modal-body">
                  
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label">地区名</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="cityname"  placeholder="城市名称，比如：上海，武汉 后面不要写 市  等多余的字">
                  </div>
                </div>
                
                <div class="form-group">
                 <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="inlineRadio1" name="type" value="1">
                        <label for="inlineRadio1"> 开启 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" name="type" value="2">
                        <label for="inlineRadio2"> 关闭 </label>
                    </div>
                  </div>
                </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" onclick="add()" class="btn btn-default">确认添加</button>
                  </div>
                </div>
                 </form>
              </div>
            </div>
            
            <script type="text/javascript">
			//查询ip归属地
		
            //添加用户
			function add(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/area/add');?>",
			          data: $('#from').serialize(),
			          success: function (data) {
				          console.log(data);
			              if(data.code == '200'){
                              layer.msg("添加成功", {icon:1,time:1000,end:function(){
                                      window.location.reload();
                                  }});
			              }else{
                              layer.msg("添加失败", {icon:2,time:1000})
			              }
			          },
			          error: function(data) {
			              alert("error:"+data.responseText);
			           }
			  });
			}

			

			function deletec(id){
                layer.confirm('确定要删除该地区吗？', function (index) {
                    $.get("<?php echo url::s('admin/area/delete','id=');?>" + id, function(result){

                        if(result.code == '200'){
                            layer.msg(result.msg, {icon:1,time:1000,end:function () {
                                    window.location.reload();
                                }});
                        }else{
                            layer.msg(result.msg, {icon:2,time:1000})
                        }

                    });
                });
			}
            </script>
            

<!-- End Moda Code -->


 <!-- Modal -->
            <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
              <form class="form-horizontal" id="from" method="get" action="<?php echo url::s('admin/member/index');?>">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">搜索用户</h4>
                  </div>
                  <div class="modal-body">
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label">关键词</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="member_id"  placeholder="会员名/手机号">
                  </div>
                </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-default">搜索</button>
                  </div>
                </div>
                 </form>
              </div>
            </div>
            
     <!-- End Moda Code -->
 
  </div>
  <!-- End Row -->
  
</div>
<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
