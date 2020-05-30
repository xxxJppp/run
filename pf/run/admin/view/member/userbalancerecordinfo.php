<?php

use xh\library\url;
use xh\library\model;
use xh\library\ip;

include_once(PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>

<div class="container-padding">


    <!-- Start Row -->
    <div class="row">
        <!-- Start Panel -->
        <div class="col-md-12">
            <div class="panel panel-default">

                <div>
                    <div class="panel-title">
                     <p>用户余额 <span style="font-size: 15px;margin-left:20px;"> <?php echo $user['balance']; ?> </span>

                        本次提现：<?php echo $orderamount;?>
                        <a href="#"
                           onclick="ok('<?php echo $orderid; ?>')"
                           class="btn btn-success "><i
                                    class="fa fa-user-md"></i>确认</a>
                     </p>
                    </div>
                </div>

                <div class="panel-body table-responsive">
                    <table class="layui-table" style="width:100%;" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>业务ID</th>
                            <th>账变前</th>
                            <th>金额</th>
                            <th>账变后</th>
                            <th>类型</th>
                            <th>备注</th>
                            <th>时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="6" style="text-align: center;">暂时没有数据!</td></tr>'; ?>

                        <?php foreach ($result['result'] as $ru) {?>
                          <tr>

                              <td><?php echo $ru['id']; ?></td>

                              <td><?php echo $ru['biz_id']; ?></td>

                              <td><?php echo $ru['before']; ?></td>

                              <td><?php echo $ru['money']; ?></td>

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
                                    parent.location.reload();
                                }
                            });
                        } else {
                            layer.msg(result.msg, {icon: 2, time: 1000})
                        }

                    });
                });
            }
        </script>


        <!-- End Moda Code -->


    </div>
    <!-- End Row -->

</div>
<!-- END CONTAINER -->
