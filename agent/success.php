
<?php 


if ($_SERVER['REMOTE_ADDR']!='182.122.101.153') {
    
    //exit('检测中....');
}

 ?>
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>充值成功</title>
    <link href="./demo/css/Reset.css" rel="stylesheet" type="text/css">
    <script src="./demo/js/jquery-1.11.3.min.js"></script>
    <link href="./demo/css/main12.css" rel="stylesheet" type="text/css">
    <style>
        .pay_li input{
            display: none;
        }
        .immediate_pay{
            border:none;
        }
        .PayMethod12
        {
            min-height: 150px;
        }
        @media screen and (max-width: 700px) {
            .PayMethod12{
                padding-top:0;
            }
            .order-amount12{
                margin-bottom: 0;
            }
            .order-amount12,.PayMethod12{
                padding-left: 15px;padding-right: 15px;
            }
        }
        .order-amount12-right input{
            border:1px solid #efefef;
            width:6em;
            padding:5px 20px;
            font-size: 15px;
            text-indent: 0.5em;
            line-height: 1.8em;
        }



    </style>
    

    <script>
        if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
            //window.location.href = " ";
        } else {

        }
    </script>
</head>
<body style="background-color:#f9f9f9">
 
<!--弹窗开始-->
<div class="pay_sure12">
 
</div>
<!--弹窗结束-->
<!--导航-->
<div class="w100 navBD12">
    <div class="w1080 nav12">
        <div class="nav12-left">
            <a href="/"><img src="./demo/images/logo2.png" style="max-height: 38px;"></a>
            <span class="shouyintai"></span>
        </div>
        <div class="nav12-right">
        </div>
    </div>
</div>


<p align="center">充值成功！</p>

<p align="center">

<a class="mui-tab-item" href="api.php">
				 
				<span class="mui-tab-label">返回继续充值</span>
			</a>

</p>
</html>