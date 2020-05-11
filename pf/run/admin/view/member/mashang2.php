<?php
use xh\library\url;
use xh\library\model;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
?>

<!-- START CONTENT -->
<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">

        <ol class="breadcrumb">
            <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
            <li class="active">码商管理组</li>
        </ol>

        <!-- Start Page Header Right Div -->
        <div class="right">
            <div class="btn-group" role="group" aria-label="...">
                <a data-toggle="modal" data-target="#add" class="btn btn-light">添加会员</a>
                <a href="?verification=<?php echo mt_rand(1000,9999);?>" class="btn btn-light"><i class="fa fa-refresh"></i></a>
                <a data-toggle="modal" data-target="#search" class="btn btn-light"><i class="fa fa-search"></i></a>

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
                    <div class="panel-title">
                        用户组
                    </div>
                    <div class="panel-body table-responsive">
                        <p>你可以在这里定义用户组权限，让你的员工能够更方便的帮助你管理系统。</p>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <td>用户名</td>
                                <td>ID</td>
                                <td>用户组</td>
                                <td>用户余额</td>
                                <td>IP地址</td>
                                <td>今日跑量</td>
                                <td>今日下发金额</td>
                                <td>未下发金额</td>
                                <td>今日订单数</td>
                                <td>今日成功数</td>
                                <td>今日成功率</td>
                                <td>今日码商佣金</td>
                                <td>昨日订单数</td>
                                <td>昨日成功数</td>
                                <td>昨日率</td>
                                <td>昨日码商佣金</td>
                                <td>操作</td>
                                <td>所有码上下线</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  foreach ($member['result'] as $em){?>
                                <tr>
                                    <td><?php echo $em['username'];?></td>
                                    <td><?php echo $em['id'];?></td>
                                    <td><?php $group = $mysql->query("client_group","id={$em['group_id']}")[0]; echo is_array($group) ? '<span style="color:orange;"><b>'.$group['name'].'</b></span>' : '<span style="color:red;">未分配</span>'; ?></td>
                                    <td><?php echo $em['balance'];?></td>
                                    <td><?php echo $em['ip'];?></td>
                                    <td>3</td>
                                    <td><b>1</b></td>
                                    <td><b>2</b></td>
                                    <td>3</td>
                                    <td><b>1</b></td>
                                    <td><b>2</b></td>
                                    <td>3</td>
                                    <td><b>1</b></td>
                                    <td><b>2</b></td>
                                    <td>3</td>
                                    <td><b>1</b></td>
                                    <td><b>2</b></td>
                                    <td>

                                            <a href="<?php ?>"  class="btn btn-default btn-xs"><i class="fa fa-edit"></i>修改</a>
                                            <a href="#" onclick="delGroup('')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>删除</a>

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
                                <h4 class="modal-title">添加会员</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">用户名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-line" name="username"  placeholder="登录用户名">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">密码</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-line" name="pwd"  placeholder="登录密码">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">权限组</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="group_id">
                                            <?php foreach ($groups as $gp){?>
                                            <option value="<?php echo $gp['id'];?>"><?php echo $gp['name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">手机号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-line" name="phone"  placeholder="手机号码">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">上级ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-line" name="level_id"  placeholder="0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">账户余额</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-line" name="balance"  placeholder="0.00">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">账户金额</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-line" name="money"  placeholder="0.00">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">是否码商</label>
                                    <div class="col-sm-10">
                                        <span style="float:left;width:60px">不是 <input style="width:20px;" type="radio" class="form-control" name="is_mashang" value="0" ></span>
                                        <span style="float:left;width:60px">  是  <input style="width:20px;" type="radio" class="form-control " name="is_mashang" value="1"></span>
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
                function ipGet(ip,obj){
                    $.get("<?php echo url::s('admin/employee/ipGet','ip=');?>" + ip, function(result){
                        if(result.code == '200'){
                            //swal("操作提示", result.msg, "success")
                            $(obj).html(result.data.city);
                        }else{
                            swal("操作提示", "查询失败,请重试", "error");
                        }

                    });
                }
                //复制文本到粘贴板
                function copy(str){
                    var save = function (e){
                        e.clipboardData.setData('text/plain',str);//下面会说到clipboardData对象
                        e.preventDefault();//阻止默认行为
                    }
                    document.addEventListener('copy',save);
                    document.execCommand("copy");//使文档处于可编辑状态，否则无效
                    swal("操作提示", "复制成功！", "success")
                }

                //添加用户
                function add(){
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<?php echo url::s('admin/member/add');?>",
                        data: $('#from').serialize(),
                        success: function (data) {
                            console.log(data);
                            if(data.code == '200'){
                                swal("操作提示", data.msg, "success");
                                setTimeout(function(){location.href = '';},1500);
                            }else{
                                swal("操作提示", data.msg, "error");
                            }
                        },
                        error: function(data) {
                            alert("error:"+data.responseText);
                        }
                    });
                }

                //选择头像
                function imgSelect(id){
                    document.getElementById(id).click();
                }

                //上传头像
                function uploadPic(bid,id){
                    var pic = $(bid)[0].files[0];
                    var fd = new FormData();
                    fd.append('avatar', pic);
                    $.ajax({
                        url:"<?php echo url::s('admin/member/avatarUpload','id=');?>" + id,
                        type:"post",
                        // Form数据
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                            if(data.code == '200'){
                                swal("操作提示", data.msg, "success");
                                $('#imgCode_' + id).attr('src','<?php echo str_replace('admin', 'index', URL_VIEW) . '/upload/avatar/';?>' + id + '/' + data.data.img);
                            }else{
                                swal("操作提示", data.msg, "error");
                            }
                        }
                    });

                }

                function deletec(id){
                    swal({
                            title: "危险提示",
                            text: "你确定要删除该会员吗？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "是的,我要删除该会员!",
                            closeOnConfirm: false
                        },
                        function(){
                            $.get("<?php echo url::s('admin/member/delete','id=');?>" + id, function(result){

                                if(result.code == '200'){
                                    swal("操作提示", result.msg, "success");
                                    setTimeout(function(){location.href = '';},1500);
                                }else{
                                    swal("操作提示", result.msg, "error");
                                }

                            });


                        });
                }


                function deletes(){
                    swal({
                            title: "非常危险",
                            text: "你确定要批量删除已选中的会员吗？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#dd6b55",
                            confirmButtonText: "是的,我要删除这些会员!",
                            closeOnConfirm: false
                        },
                        function(){
                            $("input[name='items']:checked").each(function(){
                                $.get("<?php echo url::s('admin/member/delete','id=');?>" + $(this).val(), function(result){
                                    swal("操作提示", '当前操作已经执行完毕!', "success");
                                    setTimeout(function(){location.href = '';},1500);
                                });
                            });

                        });

                }


                function showBtn(){
                    var Inc = 0;
                    $("input[name='items']:checkbox").each(function(){
                        if(this.checked){
                            $('#deletes').show();
                            return true;
                        }
                        Inc++;
                    });
                    if($("input[name='items']:checkbox").length == Inc){
                        $('#deletes').hide();
                    }
                }

            </script>


            <!-- End Moda Code -->
            <!-- Modal -->
            <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="form-horizontal" id="from" method="get" action="<?php echo url::s('admin/member/mashang');?>">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">搜索码商</h4>
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

    <?php include_once (PATH_VIEW . 'common/footer.php');?>

</div>
<!-- End Content -->

<?php include_once (PATH_VIEW . 'common/chat.php');?>

<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/jquery.min.js"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="<?php echo URL_VIEW;?>/static/console/js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/plugins.js"></script>

<!-- ================================================
Sweet Alert
================================================ -->
<script src="<?php echo URL_VIEW;?>/static/console/js/sweet-alert/sweet-alert.min.js"></script>
<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/bootstrap-select/bootstrap-select.js"></script>

<script>
    function user_query(obj){
        location.href = "<?php echo url::s('admin/member/mashang',"member_id=");?>" + $(obj).val();
    }

    $(function(){
        //实现全选与反选
        $("#checkboxAll").click(function() {
            if (this.checked){
                $("input[name='items']:checkbox").each(function(){
                    $(this).prop("checked", true);
                });
                showBtn();
            } else {
                $("input[name='items']:checkbox").each(function() {
                    $(this).prop("checked", false);
                });
                showBtn();
            }
        });
    });
</script>

</body>
</html>