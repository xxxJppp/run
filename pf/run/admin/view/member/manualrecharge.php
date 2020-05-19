<?php
use xh\library\ip;
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
$fix = DB_PREFIX;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>管理中心</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/Front/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Front/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/Front/css/animate.css" rel="stylesheet">
    <link href="/Public/Front/css/style.css" rel="stylesheet">
    <link href="/Public/Front/css/zuy.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/Front/js/plugins/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Front/iconfont/iconfont.css"/>
<body class="gray-bg">
<div class="content">
    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <!--条件查询-->
                    <div class="ibox-title">
                        <h5>人工充值扣款</h5>
                        <div class="ibox-tools">
                            <a data-toggle="modal" data-target="#add1" class="btn btn-light">人工充值扣款</a>
                            <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
                               style="cursor:pointer;">ဂ</i>
                        </div>
                    </div>

                    <table class="layui-table" lay-data="{width:'100%',limit:15,id:'userData'}">
                        <thead>
                        <tr>
                            <th lay-data="{field:'check',width:80,checkbox:true}"></th>
                            <th lay-data="{field:'id',width:90}">ID</th>
                            <th lay-data="{field:'uid',width:130}">码商账号</th>
                            <th lay-data="{field:'money',width:130}">金额</th>
                            <th lay-data="{field:'remark',width:130}">备注</th>
                            <th lay-data="{field:'status',width:130}">状态</th>
                            <th lay-data="{field:'time',width:130}">时间</th>
                            <th lay-data="{field:'op_user',width:130}">操作ID/用户名</th>
                            <!--<th lay-data="{field:'mas', width:180,style:'color:#C00;'}">操作</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($member['result'] as $em) { ?>
                            <tr id="user_<?php echo $em['id']; ?>">
                                <td></td>
                                <td style="text-align:center; color:#090;"><?php echo $em['id']; ?> </td>
                                <td style="text-align:center; color:#090;">
                                    <?php $group = $mysql->query("client_user", "id={$em['uid']}")[0];
                                    echo is_array($group) ? '<span>' . $group['username'] . '</span>' : '<span">-</span>'; ?>
                                </td>

                                <td style="text-align:center; color:#090;">
                                    <?php
                                    if($em['status']==1){
                                        echo $em['money'];
                                    }else{
                                        echo "-".$em['money'];
                                    }
                                    ?>
                                </td>
                                <td style="text-align:center; color:#090;"><?php echo $em['remark']; ?> </td>
                                <td style="text-align:center; color:#090;"><?php if($em['status']==1){echo "充值";}else{echo "扣款";}; ?> </td>
                                <td style="text-align:center; color:#090;"><?php echo date("Y-m-d H:i:s",$em['time']); ?> </td>
                                <td style="text-align:center; color:#090;"><?php echo $em['op_user']; ?> </td>

                                <!--<td>
                                    <button class="layui-btn layui-btn-small"
                                            onclick="order_view('<?php echo $em['username']; ?>->修改密码','/admin/member/passwordedit.do?id=<?php echo $em['id']; ?>',500,350)">
                                        修改密码
                                    </button>
                                    <button class="layui-btn layui-btn-small"
                                            onclick="del_mashang(this,'<?php echo $em['id']; ?>')">
                                        删除
                                    </button>
                                </td>-->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <!--交易列表-->
                    <div class="page">
                        <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">
                            <!--    <span class="layui-laypage-curr current"><em class="layui-laypage-em"></em><em>1</em></span>
                                  <a class="num" href="/agent_Order_index.html?p=2">2</a><
                                  a class="num" href="/agent_Order_index.html?p=3">3</a>
                                  <a class="next layui-laypage-next" href="/agent_Order_index.html?p=2">下一页</a> </div>       -->
                            <?php (new model())->load('page', 'turn')->auto($member['info']['pageAll'], $member['info']['page'], 10); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="add1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" id="from">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">人工充值扣款</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">码商账号</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-line" name="username" placeholder="码商用户名" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">金额</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-line" name="money" placeholder="输入金额" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">备注</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-line" rows="3"  name="remark"  placeholder="备注信息"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">充值状态</label>
                            <div class="col-sm-10">
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" name="open" value="1" checked>
                                    <label for="inlineRadio1"> 充值 </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="inlineRadio2" name="open" value="2">
                                    <label for="inlineRadio2"> 扣款 </label>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                        <button type="button" onclick="add()" class="btn btn-success"><i class="fa fa-refresh"></i>确认添加</button>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/bootstrap.min.js"></script>
<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Front/js/content.js"></script>
<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/Util.js" charset="utf-8"></script>
<script>
    layui.use(['laydate', 'laypage', 'layer', 'table', 'form'], function () {
        var laydate = layui.laydate //日期
            , laypage = layui.laypage //分页
            , layer = layui.layer //弹层
            , form = layui.form //表单
            , table = layui.table; //表格
        //日期时间范围
        laydate.render({
            elem: '#createtime'
            , type: 'datetime'
            , theme: 'molv'
            , range: '|'
        });
        //日期时间范围
        laydate.render({
            elem: '#successtime'
            , type: 'datetime'
            , theme: 'molv'
            , range: '|'
        });
    });

    /*订单-查看*/
    function order_view(title, url, w, h) {
        x_admin_show(title, url, w, h);
    }
    function open_erweima(uid) {
        layer.confirm('确认要上线吗？', function (index) {
            $.ajax({
                url: "/admin/member/openrobin",
                type: 'post',
                data: 'member_id=' + uid,
                success: function (res) {
                    if (res.code == 200) {
                        layer.msg(res.msg, {icon: 1, time: 1000,end:function () {
                                window.location.href = "/admin/member/pankou";
                            }});
                    }
                }
            });
        });
    }

    function off_erweima(uid) {
        layer.confirm('确认要下线吗？', function (index) {
            $.ajax({
                url: "/admin/member/offrobin",
                type: 'post',
                data: 'member_id=' + uid,
                success: function (res) {
                    console.log(res);
                    if (res.code == 200) {
                        layer.msg(res.msg, {icon: 1, time: 1000,end:function () {
                                window.location.href = "/admin/member/pankou";
                            }});

                    }
                }
            });
        });
    }
    //人工充值
    var isallvop = 1;
    function add(){
        if(isallvop == 1) {
            isallvop = 0;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo url::s('admin/member/manualRechargeResult');?>",
                data: $('#from').serialize(),
                success: function (data) {
                    if (data.code == '200') {
                        layer.msg('添加成功', {
                            icon: 1,
                            time: 1000,
                            end: function () {
                                isallvop = 1;
                                window.location.href = "/admin/member/manualrecharge";
                            }
                        });
                    } else {
                        isallvop = 1;
                        layer.msg(data.msg, {icon: 1, time: 1000});
                    }
                },
                error: function (data) {
                    isallvop = 1;
                    alert("error:" + data.responseText);
                }
            });
        }
    }
    /*订单-删除*/
    function order_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                url: "/admin/member/delete",
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

    $('#export').on('click', function () {
        window.location.href
            = "/agent_Order_exportorder_status_2.html";
    });
    $('#pageList').change(function () {
        $('#pageForm').submit();
    });

    function deletes() {
        swal({
                title: "非常危险",
                text: "你确定要批量删除已选中的会员吗？",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是的,我要删除这些会员!",
                closeOnConfirm: false
            },
            function () {
                $("input[name='items']:checked").each(function () {
                    $.get("<?php echo url::s('admin/member/delete', 'id=');?>" + $(this).val(), function (result) {
                        swal("操作提示", '当前操作已经执行完毕!', "success");
                        setTimeout(function () {
                            location.href = '';
                        }, 1500);
                    });
                });

            });

    }

    function showBtn() {
        var Inc = 0;
        $("input[name='items']:checkbox").each(function () {
            if (this.checked) {
                $('#deletes').show();
                return true;
            }
            Inc++;
        });
        if ($("input[name='items']:checkbox").length == Inc) {
            $('#deletes').hide();
        }
    }
</script>
</body>
</html>
