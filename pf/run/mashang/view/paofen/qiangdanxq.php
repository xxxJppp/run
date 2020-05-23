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
    <title>{:C('VIEW_TITLE')}</title>
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
    }</style>

    <link href="/homestyle/css/app.2150f8cc.css" rel="preload" as="style">
    <link href="/homestyle/css/chunk-vendors.e9f6096e.css" rel="preload" as="style">
    <link href="/homestyle/js/app.7b6aaa54.js" rel="preload" as="script">
    <link href="/homestyle/js/chunk-vendors.9dc788ca.js" rel="preload" as="script">
    <link href="/homestyle/css/chunk-vendors.e9f6096e.css" rel="stylesheet">
    <link href="/homestyle/css/app.2150f8cc.css" rel="stylesheet">
    <script charset="utf-8" src="/homestyle/js/chunk-2c41e510.2c195371.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-02960128.d8e4678b.css">
    <script charset="utf-8" src="/homestyle/js/chunk-02960128.e3c7e508.js"></script>
    <script charset="utf-8" src="/homestyle/js/chunk-170f8e40.69f62aae.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-5753040b.49d996f2.css">
    <script charset="utf-8" src="/homestyle/js/chunk-5753040b.b03c4f33.js"></script>
    <script charset="utf-8" src="/homestyle/js/chunk-2d0f0c02.2926760c.js"></script>
    <script charset="utf-8" src="/homestyle/js/chunk-2d209530.b5cf094b.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-260b9ee0.d82954b0.css">
    <script charset="utf-8" src="/homestyle/js/chunk-260b9ee0.1a81655c.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-5ea3ec15.30d377cf.css">
    <script charset="utf-8" src="/homestyle/js/chunk-5ea3ec15.3c920ba3.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-fde07e7a.adc0509a.css">
    <script charset="utf-8" src="/homestyle/js/chunk-fde07e7a.d481bd8c.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-ae7bdc24.38e0efd9.css">
    <script charset="utf-8" src="/homestyle/js/chunk-ae7bdc24.95a06cff.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-57d8499b.96222562.css">
    <script charset="utf-8" src="/homestyle/js/chunk-57d8499b.a72ea326.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-45fabb50.f6fb2ae2.css">
    <script charset="utf-8" src="/homestyle/js/chunk-45fabb50.f76bd21f.js"></script>
    <link rel="stylesheet" type="text/css" href="/homestyle/css/chunk-d08caeb6.b385e467.css">
    <script charset="utf-8" src="/homestyle/js/chunk-d08caeb6.4d2b8171.js"></script>
    <style type="text/css">
        .file-uploads {
            overflow: hidden;
            position: relative;
            text-align: center;
            display: inline-block
        }

        .file-uploads.file-uploads-html4 input, .file-uploads.file-uploads-html5 label {
            background: #fff;
            opacity: 0;
            font-size: 20em;
            z-index: 1;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
            width: 100%;
            height: 100%
        }

        .file-uploads.file-uploads-html4 label, .file-uploads.file-uploads-html5 input {
            background: rgba(255, 255, 255, 0);
            overflow: hidden;
            position: fixed;
            width: 1px;
            height: 1px;
            z-index: -1;
            opacity: 0
        }

        #img1 {
            width: 100%;
        }
    </style>

    <script src="/Public/Front/js/jquery.min.js"></script>

</head>
<body class="van-overflow-hidden">
<div id="app">
    <div data-v-7b3d257d="" class="account-detail">
        <div data-v-7b3d257d="" class="van-popup van-popup--right" style="width: 100%; height: 100%; z-index: 2006;">
            <div data-v-2496acda="" data-v-7b3d257d="" class="upload-code">
                <div data-v-2496acda="" class="MB10 van-nav-bar van-hairline--bottom" style="z-index: 1;">
                    <div data-v-2496acda="" class="van-nav-bar__left" onClick="javascript :history.back(-1);"><i
                            data-v-2496acda="" class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i>
                        <span data-v-2496acda="" class="van-nav-bar__text">返回</span></div>
                    <div data-v-2496acda="" class="van-nav-bar__title van-ellipsis">订单详情</div>
                    <div data-v-2496acda="" class="van-nav-bar__right"></div>
                </div>
                <div data-v-2496acda="" id="filelist1"><!---->
                    <span data-v-2496acda="" id="filePicker1" class="input-file file-uploads file-uploads-html5"><div
                            data-v-2496acda="">
                     			 

				 </span></div>

                <div data-v-2496acda="" class="flexh" style="line-height: 22px;padding-top: 5px;margin-left: 13%;">
                    <div data-v-2496acda="" class="font-14 example-guide"
                         style="width: 25%;margin-left: 10px;text-align: center;font-size: 16px;">订单号
                    </div>
                    <div data-v-2496acda="" class="van-cell van-field"
                         style="width: 50%;padding: 0;line-height: .2rem;margin: .12rem .1rem 0 10%;background: #fff;font-size: 16px;">
                        <?php  echo $result['trade_no']; ?>
                    </div>
                </div>

                <div data-v-2496acda="" class="flexh" style="line-height: 22px;padding-top: 5px;margin-left: 13%;">
                    <div data-v-2496acda="" class="font-14 example-guide"
                         style="width: 25%;margin-left: 10px;text-align: center;font-size: 16px;">收款类型
                    </div>
                    <div data-v-2496acda="" class="van-cell van-field"
                         style="width: 50%;padding: 0;line-height: .2rem;margin: .12rem .1rem 0 10%;background: #fff;font-size: 16px;">支付宝</div>
                </div>

                <div data-v-2496acda="" class="flexh" style="line-height: 22px;padding-top: 5px;margin-left: 13%;">
                    <div data-v-2496acda="" class="font-14 example-guide"
                         style="width: 25%;margin-left: 10px;text-align: center;font-size: 16px;">收款名称
                    </div>
                    <div data-v-2496acda="" class="van-cell van-field"
                         style="width: 50%;padding: 0;line-height: .2rem;margin: .12rem .1rem 0 10%;background: #fff;font-size: 16px;"><?php echo $account['name'];?></div>
                </div>

                <div data-v-2496acda="" class="flexh" style="line-height: 22px;padding-top: 5px;margin-left: 13%;">
                    <div data-v-2496acda="" class="font-14 example-guide"
                         style="width: 25%;margin-left: 10px;text-align: center;font-size: 16px;">收款金额
                    </div>
                    <div data-v-2496acda="" class="van-cell van-field"
                         style="width: 50%;padding: 0;line-height: .2rem;margin: .12rem .1rem 0 10%;background: #fff;font-size: 16px;">
                        <?php echo $result['amount']; ?>
                    </div>
                </div>

                <div data-v-2496acda="" class="flexh" style="line-height: 22px;padding-top: 5px;margin-left: 13%;">
                    <div data-v-2496acda="" class="font-14 example-guide"
                         style="width: 25%;margin-left: 10px;text-align: center;font-size: 16px;">更新时间
                    </div>
                    <div data-v-2496acda="" class="van-cell van-field"
                         style="width: 50%;padding: 0;line-height: .2rem;margin: .12rem .1rem 0 10%;background: #fff;font-size: 16px;">
                        <?php echo  $result['creation_time']; ?></div>
                </div>

                <div data-v-2496acda="" class="flexh" style="line-height: 22px;padding-top: 5px;margin-left: 13%">
                    <div data-v-2496acda="" class="font-14 example-guide"
                         style="width: 25%;margin-left: 10px;text-align: center;font-size: 16px;">订单状态
                    </div>
                    <div data-v-2496acda="" class="van-cell van-field"
                         style="width: 50%;padding: 0;line-height: .2rem;margin: .12rem .1rem 0 10%;background: #fff;font-size: 16px;">
                        <?php echo $result['status_name'];?>
                    </div>
                </div>


                <!--div data-v-2496acda="" class="gray font-13 ML20 MR10" style="margin-top: 0.05rem;">若与收款码对应的实名认证姓名不一致，该收款码将审核不通过</div-->

                <?php
                if(!is_array($shensu)){
                if($result['status']!=4){
                ?>
                <button data-v-2496acda="" class="upload-code-btn van-button van-button--primary van-button--normal "
                        style="margin: .15rem .2rem 0 .2rem;"
                        onclick="order_view('<?php echo $id;?>')"><span
                        data-v-2496acda="" class="van-button__text">
我要申诉</span></button>
                <?php }else{ ?>
                    <button data-v-2496acda="" class="upload-code-btn van-button van-button--primary van-button--normal "
                            style="margin: .15rem .2rem 0 .2rem;"><span data-v-2496acda="" class="van-button__text">
已完成</span></button>
                    <?php }
                }else{ ?>
                <button data-v-2496acda="" class="upload-code-btn van-button van-button--primary van-button--normal "
                        style="margin: .15rem .2rem 0 .2rem;"><span data-v-2496acda="" class="van-button__text">
已投诉</span></button>
                <?php }?>
                <button data-v-2496acda="" class="upload-code-btn van-button van-button--primary van-button--normal "
                        style="margin: .15rem .2rem 0 .2rem;"
                        onclick="confirmSK('<?php echo $result['status']; ?>','<?php echo $id;?>')"><span
                        data-v-2496acda="" class="van-button__text">
确认收款</span></button>
                <div data-v-2496acda="" class="van-popup van-popup--center"
                     style="width: 95%; height: 95%; z-index: 2009; display: none;">
                    <img data-v-2496acda="" src="/homestyle/img/wx_guide.34bc1b9b.jpg" alt="guide" width="100%"
                         height="100%">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmSK(status,id) {
        if(status == 4){
            alert('订单已经收款完成了');
        }/*else if(status==3){
            alert('订单超时，无法手动执行');
        }*/else {
            if (confirm('手动补发也是需要扣除手续费,您是否要继续?')) {
                $.get("<?php echo url::s('/mashang/paofen/automaticReissue', "id=");?>" + id, function (ret) {
                    if (ret.code == '200') {
                        alert(ret.msg);
                            location.href = '/mashang/paofen/automaticOrder.do?id='+id;
                    } else {
                        alert(ret.msg);
                    }
                });
            }
        }

    }
    function order_view(id) {
        location.href = '/mashang/paofen/appeal?id='+id;

    }
</script>
</body>
</html>