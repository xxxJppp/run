<?php 

error_reporting(0);

?>
<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <title>CO新版聚合支付2.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    html,body,div,p,span,ul,dl,ol,h1,h2,h3,h4,h5,h6,table,td,tr{padding:0;margin:0}
    .content{width:400px;margin:100px auto;border:1px solid #ddd}
    h1{margin-bottom:30px;background-color:#eee;;border-bottom:1px solid #ddd;padding:10px;text-align: center}
    table{border-collapse:collapse;width:90%;margin:20px auto}
    table tr td{height:40px;font-size:14px}
    input,select{width:100%;line-height:25px}
    button{font-size:16px}
    </style>
</head>
<body>

<div class="content">
    <h1>模拟支付</h1>
    <form action="pay.php" method="post" target="_blank">
        <table>
            <tr>
                <td width="120">版本号：</td>
                <td>
                    <select name="bb">
                        <option value="1.0">1.0</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>订单号：</td>
                <td><input type="text" name="ddh" value="<?php echo date('Ymd',time()).rand(10000000,99999999); ?>"></td>
            </tr>

            <tr>
                <td>订单金额：</td>
                <td><input type="text" name="je" value="1.00"></td>
            </tr>

            <tr>
                <td>支付通道：</td>
                <td>
                    <select name="zftd" onChange="changePay(this.options[this.selectedIndex].value)">
						<option value="weixin">微信</option>
						<option value="alipay">支付宝</option>
						<option value="yinlian">银联</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>订单名称：</td>
                <td><input type="text" name="ddmc" value="订单名称"></td>
            </tr>

            <tr>
                <td>订单备注：</td>
                <td><input type="text" name="ddbz" value="备注"></td>
            </tr>

            <tr>
                <td></td>
                <td><button type="submit">提交订单</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>