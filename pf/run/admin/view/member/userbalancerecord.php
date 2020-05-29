<?php

use xh\library\url;
use xh\library\model;
use xh\library\ip;

include_once(PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>
<!-- START CONTENT -->

<!-- Start Page Header -->
<div class="page-header">

    <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home'); ?>">财务管理</a></li>
        <li class="active">账变</li>
    </ol>
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

                <div>
                    <form action="" style="margin-top: 20px;margin-bottom: 20px;">
                        <input type="text" style="width: 140px;" name="username" placeholder="请输入用户名" value="<?php echo $username;?>">
                        <input type="submit" style="border:0px" value="查询" class="btn btn-success">
                    </form>
                </div>

                <div class="panel-body table-responsive">
                    <table class="layui-table" style="width:1010px;" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>业务ID</th>
                            <th>账变金额</th>
                            <th>账变前金额</th>
                            <th>账变后金额</th>
                            <th>账变类型</th>
                            <th>备注</th>
                            <th>账变时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="6" style="text-align: center;">暂时没有数据!</td></tr>'; ?>

                        <?php foreach ($result['result'] as $ru) {?>
                          <tr>
                              <td><?php echo $ru['id']; ?></td>

                              <td><?php $user = $mysql->query("client_user", "id={$ru['uid']}")[0]; echo isset($user['username'])?$user['username']:''; ?></td>

                              <td><?php echo $ru['biz_id']; ?></td>

                              <td><?php echo $ru['money']; ?></td>

                              <td><?php echo $ru['before']; ?></td>

                              <td><?php echo $ru['after']; ?></td>

                              <td>
                                  <?php switch($ru['catalog']){
                                      case 1:
                                          echo "盘口获利";
                                          break;
                                      case 2:
                                          echo "代理获利";
                                          break;
                                      case 3:
                                          echo "码商获利";
                                          break;
                                      case 4:
                                          echo "提现";
                                          break;
                                      case 5:
                                          echo "接单押金";
                                          break;
                                      case 6:
                                          echo "充值";
                                          break;
                                      default:
                                          echo "未定义类型";
                                          break;
                                  } ; ?>
                              </td>

                              <td><?php echo $ru['remark']; ?></td>

                              <td><?php echo date("Y/m/d H:i:s", $ru['create_time']);; ?></td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div style="float:right;">
                    <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
                </div>
                <div style="clear: both"></div>

            </div>
        </div>
        <!-- End Panel -->
        <script type="text/javascript">

            function ok(id) {
                layer.confirm('你确认已经为该提现订单打过款了吗？', function (index) {
                    $.get("<?php echo url::s('admin/member/updateagentWithdraw', "type=2&id=");?>" + id, function (result) {

                        if (result.code == '200') {
                            layer.msg(result.msg, {
                                icon: 1, time: 1000, end: function () {
                                    window.location.reload();
                                }
                            });
                        } else {
                            layer.msg(result.msg, {icon: 2, time: 1000})
                        }

                    });
                });
            }

            function turnDown(id) {
                layer.prompt({
                        title:"请输入驳回信息反馈给用户",
                        formType:2,
                        btn:'驳回'
                    },
                    function (inputValue) {
                        if (inputValue === "" || inputValue === false) {
                            swal.showInputError("请输入驳回信息!");
                            return false
                        }
                        $.get("<?php echo url::s('admin/member/updateagentWithdraw', "type=3&id=");?>" + id + "&msg=" + inputValue, function (result) {
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

            function error(id) {
                layer.prompt({
                        title:"请输入异常信息反馈给用户",
                        formType:2,
                    },
                    function (inputValue) {
                        if (inputValue === "" || inputValue === false) {
                            layer.msg("请输入异常信息!", {icon:2,time:1000})
                            return false
                        }
                        $.get("<?php echo url::s('admin/member/updateagentWithdraw', "type=4&id=");?>" + id + "&msg=" + inputValue, function (result) {
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


            function flow_no(obj) {
                location.href = "<?php echo url::s('admin/member/agentwithdraw', "sorting=flow_no&code=");?>" + $(obj).val();
            }

            function wechat() {
                var wechat = $('#wechat').val();
                location.href = "<?php echo url::s('admin/alipay/automaticOrder', "sorting=alipay&code=");?>" + wechat;

            }



        </script>


        <!-- End Moda Code -->


    </div>
    <!-- End Row -->

</div>
<!-- END CONTAINER -->
