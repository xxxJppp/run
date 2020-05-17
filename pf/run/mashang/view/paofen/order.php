<?php
use xh\library\url;
use xh\library\model;

$fix = DB_PREFIX;
?>
<html lang="en" style="font-size: 100px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
    <link rel="icon" href="/favicon.ico">
    <title>订单列表</title>
    <style>body {
        background: #f2f2f2;
    }

    @media screen and (min-width: 767px) {
        #app {
            width: 540px;
            margin: 0 auto;
            min-height: 100vh;
            box-sizing: border-box;
            border: 1px solid #999;
            /* overflow-y: hidden; */
        }

        .van-popup--top {
            width: 540px;
            margin: 0 auto;
        }

    }

    .detail-info {

        background: #fff;
        margin-bottom: .1rem;
        padding: .1rem .15rem;
        box-sizing: border-box;
        font-size: .14rem;
        line-height: .22rem;
    }
    </style>


    <link href="/homestyle/css/app.2150f8cc.css" rel="preload" as="style">
    <link href="/homestyle/css/chunk-vendors.e9f6096e.css" rel="preload" as="style">
    <link href="/homestyle/js/app.7b6aaa54.js" rel="preload" as="script">
    <link href="/homestyle/js/chunk-vendors.9dc788ca.js" rel="preload" as="script">
    <link href="/homestyle/css/chunk-vendors.e9f6096e.css" rel="stylesheet">
    <link href="/homestyle/css/app.2150f8cc.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-e1f1707a.079dd8a4.css">
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-fde07e7a.adc0509a.css">
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-ae7bdc24.38e0efd9.css">
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-57d8499b.96222562.css">
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-731cdd2b.a9740232.css">
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-5ea3ec15.30d377cf.css">

</head>
<body class="">

<div id="app">
    <div data-v-9d393b54="" class="order-list">


            <div data-v-9d393b54="" class="">

                <div class="van-tabs__content">
                    <!--div data-v-9d393b54="" role="tabpanel" class="van-tab__pane" style=""></div-->
                    <?php if (is_array($result['result'][0])){

                    ?>

                    <div data-v-9d393b54="" id="item2mobile" class="van-tab__pane">
                        <?php  foreach ($result['result'] as $ru) { ?>
                            <div data-v-7b3d257d class="detail-info">

                                <div class="van-swipe-cell__wrapper"
                                     style="transform: translate3d(0px, 0px, 0px); transition-duration: 0.6s;">
                                    <div data-v-9d393b54="" class="flexh flex-between MR10">

                                        <div data-v-9d393b54="" class="flex1">
                                            <div data-v-9d393b54="" class="benefit">类型

                                                <span data-v-9d393b54=""
                                                      class="warn-color font-14">支付宝</span>
                                                <span data-v-9d393b54=""
                                                      class="green font-14 ML10"><?php
                                                    if ($ru['status'] == 1) echo '<span style="color:#039be5;">任务下发中..</span>';
                                                    if ($ru['status'] == 2) echo '<span style="color:red;">未支付</span>';
                                                    if ($ru['status'] == 3) echo '<span style="color:#bdbdbd;">订单超时</span>';
                                                    if ($ru['status'] == 4) echo '<span style="color:green;"><b>已支付</b></span>';
                                                    ?></span>
                                            </div>
                                            <div data-v-9d393b54="" class="MT03">
                                                充值单号: <?php echo $ru['out_trade_no']; ?>
                                            </div>
                                            <div data-v-9d393b54="" class="MT03" style="color: rgb(153, 153, 153);">
                                                时间:<?php echo date('Y/m/d H:i:s', $ru['creation_time']); ?></div>
                                        </div>
                                        <div data-v-9d393b54="" style="text-align: right;">
                                            <div data-v-9d393b54="" class="benefit"><span data-v-9d393b54=""
                                                                                          class="font-14 fail-color"
                                                                                          style="font-size: .20rem;">
                  <?php echo $ru['amount']; ?>元
                 </span></div>
                                            <div data-v-9d393b54="" class="green font-14" style="margin-top: 0.26rem;"
                                                 onclick="location='/mashang/paofen/orderdetail?id=<?php echo $ru['id']; ?>'">
                                                查看详情
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php }?>                    </div>
<?php }else{ ?>
            <section data-v-9d393b54="" class="MT10">
                <div data-v-392d05dd="" data-v-9d393b54="">

                    <div data-v-392d05dd="" role="feed" class="van-list">
                        <div class="van-list__finished-text">没有更多了</div>
                        <div class="van-list__placeholder"></div>
                    </div><!----></div>
            </section><?php }?>
    </div>
</div>
<script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>

</body>
</html>