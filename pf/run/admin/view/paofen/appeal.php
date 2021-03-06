<?php
use xh\library\ip;
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
include_once (PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>
<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <!--条件查询-->
                <div class="ibox-title">
                    <h5>申诉管理</h5>
                    <div class="ibox-tools">
                        <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
                           style="cursor:pointer;">ဂ</i>
                    </div>
                </div>

                <table id="tbl" lay-data="{width:'100%',limit:15,id:'userData'}" cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-filter="main_list">
                    <thead>
                    <tr>
                        <th lay-data="{field:'check',width:80,checkbox:true}"></th>
                        <th lay-data="{field:'key',width:100}"></th>
                        <th lay-data="{field:'key1',width:130}">用户名</th>
                        <th lay-data="{field:'out_trade_id', width:200,style:'color:#060;'}">订单号</th>
                        <th lay-data="{field:'memberid', width:140}">申诉理由</th>
                        <th lay-data="{field:'money', width:140}">实际到账金额</th>
                        <th lay-data="{field:'voucher', width:140  }">申诉凭证</th>
                        <th lay-data="{field:'create_time', width:200}">申请时间</th>
                        <th lay-data="{field:'mas', width:180,style:'color:#C00;'}">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result['result'] as $em) { ?>
                        <tr id="user_<?php echo $em['id']; ?>">
                            <td></td>
                            <td style="text-align:center; "> <button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</button> </td>
                            <td><?php echo $mysql->query('client_user','id='.$em['user_id'],'username')[0]['username']; ?> </td>
                            <td style="text-align:center; color:red;" >
                                <?php echo $em['trade_no']; ?>
                            </td>
                            <td style="text-align:center;"><?php echo $em['status']==1?'钱多了':'钱少了'; ?></td>
                            <td style="text-align:center;"><?php echo $em['money'];?></td>
                            <td  ><?php echo $em['voucher'];?></td>

                            <td style="text-align:center; color:#666">
                                <?php echo date('Y-m-d H:i:s',$em['create_time']);?>
                            </td>
                            <td style="text-align:center;">

                                <?php if($em['audit'] == 0){?>
                                <button class="layui-btn layui-btn-small"
                                        onclick="audit('<?php echo $em['id']; ?>',3,'')">
                                    审核
                                </button>
                                <button class="layui-btn layui-btn-small"
                                        onclick="audit('<?php echo $em['id']; ?>',2)">
                                    驳回
                                </button>
                                <?php }else if($em['audit'] == 1){ ?>
                                    <span>已审核</span>
                                <?php }else if($em['audit'] == 3){ ?>
                                    <button class="layui-btn layui-btn-small"
                                            onclick="audit('<?php echo $em['id']; ?>',1,<?php echo $em['money'];?>)">处理中
                                    </button>
                                    <button class="layui-btn layui-btn-small"
                                            onclick="audit('<?php echo $em['id']; ?>',2)">
                                        驳回
                                    </button>
                                <?php } ?>

                                <?php if($em['audit'] == 2){?>
                                   <span style="color: green">已驳回</span>
                                <?php } ?>
                            </td>
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
                        <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/bootstrap.min.js"></script>
<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Front/js/content.js"></script>
<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/Util.js" charset="utf-8"></script>
<script>
    layui.use(['laydate', 'laypage', 'layer', 'table', 'form'], function () {
        var  laypage = layui.laypage //分页
            , layer = layui.layer //弹层
            , form = layui.form //表单
            , table = layui.table; //表格



        //监听行工具事件
        table.on('tool(main_list)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
            var data = obj.data //获得当前行数据
                ,layEvent = obj.event; //获得 lay-event 对应的值

            if(layEvent === 'detail'){
                // layer.('查看操作');
                var detail='<div style="padding: 10px;width: 350px;">';
                detail+='<li>订单编号 ：'+data.out_trade_id+"</li>";
                detail+='<li>申诉时间 ：'+data.create_time+'</li>';
                detail+="<li><br><img style='width:300px;height: 530px;' src='<?php echo MASHANG;?>"+data.voucher+"' ></li>";
                detail+='</div>';
                var type=100;
                layer.open({
                    type: 1
                    ,offset:'auto'
                    ,id: 'layerDemo'+type //防止重复弹出
                    ,content: detail
                    ,btn: '关闭'
                    ,area: ['350px','600px']
                    ,btnAlign: 'c' //按钮居中
                    ,shade: 0 //不显示遮罩
                    ,yes: function(){
                        layer.closeAll();
                    }
                });
            }
        });
    });

    $('#export').on('click', function () {
        window.location.href
            = "/agent_Order_exportorder_status_2.html";
    });
    $('#pageList').change(function () {
        $('#pageForm').submit();
    });

    function voucher(url) {
        layer.open({
            title:"查看凭证",
            content:'<img src="'+url+'" alt="">'
        })
    }



    function audit(id,type,money) {
        if(money==''){
            money = "0.00";
        }
        if(type == 1){
            layer.prompt({title: '请填写正确金额', formType: 0,value:money}, function(ret, index){
                $.ajax({
                    url: "/admin/paofen/appealaudit",
                    type: 'post',
                    data: {id:id,amount:ret,type:type},
                    success: function (res) {
                        if(res.code == 1){
                            layer.msg(res.msg, {icon:1,time:1000,end:function () {
                                    window.location.href = "/admin/paofen/appeal";
                                }});
                        }else{
                            layer.msg(res.msg, {icon:2,time:1000})
                        }
                    }
                });
            });
        }else{
            $.ajax({
                url: "/admin/paofen/appealaudit",
                type: 'post',
                data: {id:id,type:type},
                success: function (res) {
                    if(res.code == 1){
                        layer.msg(res.msg, {icon:1,time:1000,end:function () {
                                window.location.href = "/admin/paofen/appeal";
                        }});
                    }else{
                        layer.msg(res.msg, {icon:2,time:1000})
                    }
                }
            });
        }

    }
</script>
