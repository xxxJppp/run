<?php
use xh\library\url;
use xh\library\model;
use xh\unity\cog;
include_once (PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>
<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <!--条件查询-->
                <div class="ibox-title">
                    <h5>配置管理</h5>
                    <div class="ibox-tools">
                        <a data-toggle="modal" data-target="#add1" class="btn btn-light">添加配置</a>
                        <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
                           style="cursor:pointer;">ဂ</i>
                    </div>
                </div>
                
                <div>
                    <form action="" style="margin-top: 20px">
                        <input type="text" name="cfg_key" placeholder="请输入键" value="<?php echo $cfg_key;?>">
                        <input type="submit" style="border:0px" value="查询" class="btn btn-success">
                    </form>

                </div>

                <table class="layui-table">
                    <thead>
                    <tr>
                        <th lay-data="{field:'id',width:90}">ID</th>
                        <th lay-data="{field:'title',width:130}">标题</th>
                        <th lay-data="{field:'cfg_key', width:100,style:'color:#060;'}">键</th>
                        <th lay-data="{field:'cfg_value', width:140}">值</th>
                        <th lay-data="{field:'status', width:100,style:'color:#060;'}">状态</th>
                        <th lay-data="{field:'create_time', width:100,style:'color:#060;'}">创建时间</th>
                        <th lay-data="{field:'mas', width:180,style:'color:#C00;'}">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!is_array($member['result'][0])) echo '<tr><td colspan="7" style="text-align: center;">暂无数据</td></tr>'; ?>
                    <?php foreach ($member['result'] as $em) { ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $em['id']; ?></td>
                            <td style="text-align:center;"><?php echo $em['title']; ?></td>
                            <td style="text-align:center;"><?php echo $em['cfg_key']; ?></td>
                            <td style="text-align:center;"><?php echo $em['cfg_value']; ?></td>
                            <td style="text-align:center;"><?php echo $em['status']==1?"启用":"禁用"; ?></td>
                            <td style="text-align:center;"><?php echo date("Y/m/d H:i:s",$em['create_time']);?></td>
                            <td>
                                <a class="layui-btn layui-btn-small" href="<?php echo url::s('admin/config/configView',"id=" . str_replace('=', '@', base64_encode($em['id'])));?>">修改</a>
                                <button class="layui-btn layui-btn-small" onclick="config_del(this,'<?php echo $em['id']; ?>')">
                                    删除
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

                <!--交易列表-->
                <div class="page">
                    <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">
                        <?php (new model())->load('page', 'turn')->auto($member['info']['pageAll'], $member['info']['page'], 10); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="add1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" id="from1" method="post" action="#">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加配置</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="title"  placeholder="标题">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">键</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="cfg_key"  placeholder="请输入键">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">值</label>
                        <div class="col-sm-10">
                          <textarea style="width: 420px;height: 120px;" name="cfg_value" placeholder="请输入值" autocomplete="off" class="layui-input"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">状态</label>
                        <div class="col-sm-10">
                            <span style="float:left;width:60px">启用 <input style="width:20px;" type="radio" class="form-control " name="status" value="1" checked></span>
                            <span style="float:left;width:60px">  禁用 <input style="width:20px;" type="radio" class="form-control" name="status" value="0"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" onclick="add()" class="btn btn-success">确认添加</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    //添加配置
    function add(){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo url::s('admin/config/configAdd');?>",
            data: $('#from1').serialize(),
            success: function (data) {
                if(data.code == '200'){
                    layer.msg('添加成功!', {icon: 1, time: 1000});
                    window.location.href="/admin/config/configList";
                }else{
                    layer.msg(data.msg, {icon: 1, time: 1000});
                }
            },
            error: function(data) {
                alert("error:"+data.responseText);
            }
        });
    }

    function config_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                url: "/admin/config/configDel",
                type: 'post',
                data: 'id=' + id,
                success: function (res) {
                    if (res.code==200) {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!', {icon: 1, time: 1000});
                    }
                }
            });
        });
    }
</script>
