<?php

function generate_rand($l){ 
  
    $c= "ABCDEFGH@4%^IJKLMNO^*PQ!RS%T&UVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    srand((double)microtime()*1000000); 

    for($i=0; $i<$l; $i++) { 

       $rand.= $c[rand()%strlen($c)]; 

    } 

    return $rand; 
} 
function timediff( $begin_time, $end_time ) { 
    if ( $begin_time < $end_time ) { 

        $starttime = $begin_time; 

        $endtime = $end_time; 

    } else { 
        $starttime = $end_time; 

        $endtime = $begin_time; 
    } 
    $timediff = $endtime - $starttime; 

    $days = intval( $timediff / 86400 ); 

    $remain = $timediff % 86400; 

    $hours = intval( $remain / 3600 ); 

    $remain = $remain % 3600; 

    $mins = intval( $remain / 60 ); 

    $secs = $remain % 60; 

    $res = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs ); 

    return $days.'天'.$hours.'小时'.$mins.'分可挂卖单';

    //return $res; 
}



function getClientMobileBrand($agent = ''){
    if ($agent == '') {
         
        $agent = $_SERVER['HTTP_USER_AGENT']; 
    }
    if(preg_match('/iPhone\s([^\s|;]+)/i', $agent, $regs)) {
        $mobile_brand = '苹果';
       
        $mobile_ver = $regs[0];
    }elseif(preg_match('/SAMSUNG|Galaxy|GT-|SCH-|SM-\s([^\s|;]+)/i', $agent, $regs)) {
         $mobile_brand = '三星';


        $mobile_ver = $regs[0];
    }elseif(preg_match('/Huawei|Honor|H60-|H30-\s([^\s|;]+)/i', $agent, $regs)) {
         $mobile_brand = '华为';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/Mi note|mi one\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = '小米';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/HM NOTE|HM201\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = '红米';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/Coolpad|8190Q|5910\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = '酷派';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/ZTE|X9180|N9180|U9180\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = '中兴';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/OPPO|X9007|X907|X909|R831S|R827T|R821T|R811|R2017\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = 'OPPO';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/HTC|Desire\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = 'HTC';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/Nubia|NX50|NX40\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = '努比亚';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/M045|M032|M355\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = '魅族';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/Gionee|GN\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = '金立';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/HS-U|HS-E\s([^\s|;]+)/i', $agent, $regs)) {        
        $mobile_brand = '海信';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/Lenove\s([^\s|;]+)/i', $agent, $regs)) {
        $mobile_brand = '联想';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/ONEPLUS\s([^\s|;]+)/i', $agent, $regs)) {
        $mobile_brand = '一加';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/vivo\s([^\s|;]+)/i', $agent, $regs)) {
        $mobile_brand = 'vivo';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/K-Touch\s([^\s|;]+)/i', $agent, $regs)) {
        $mobile_brand = '天语';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/DOOV\s([^\s|;]+)/i', $agent, $regs)) {
        $mobile_brand = '朵唯';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/GFIVE\s([^\s|;]+)/i', $agent, $regs)) {
        $mobile_brand = '基伍';
        $mobile_ver = $regs[0];
    }elseif(preg_match('/Nokia\s([^\s|;]+)/i', $agent, $regs)) {
        $mobile_brand = '诺基亚';
        $mobile_ver = $regs[0];
    }else{
        $mobile_brand = '其他';
    }
    return $mobile_brand.':'.$mobile_ver;
}




function cts($id,$lev=0) {
    
    $mysql= Mysql::getIns();

    $arr = $mysql->select_all('z_user','id,name,addtime,login_num,tjr,tel,lasttime');
    
    static  $data = array();

    foreach ($arr  as $k => $v) {
        
        
           if ($v['id'] == $id) {
                
                $v['levs'] = $lev;

                $data[] = $v;
                if ($lev < 2) {
                    $data = cts($v['tjr'],$lev+1);
                }
           }

        }    
      
      return $data;


} 

function cts2($id,$lev=1) {
    
    $mysql= Mysql::getIns();

    $arr = $mysql->select_all('ysk_user','userid,pid,mobile');
    
    static  $data = array();

     foreach ($arr  as $k => $v) {
        
        
           if ($v['pid'] == $id) {
                
                $v['levs'] = $lev;

                $data[] = $v;
                if ($lev < 5) {
                    $data = cts2($v['id'],$lev+1);
                }
           }

        }   
      
      return $data;


} 

function ctss($id,$lev=0) {
    
    $mysql= Mysql::getIns();

    $arr = $mysql->select_all('z_user','id,name,addtime,login_num,tjr,tel,lasttime','cid = 1');
    
    static  $data = array();

    foreach ($arr  as $k => $v) {
        
        
           if ($v['tjr'] == $id) {
                
                $v['levs'] = $lev;

                $data[] = $v;
                if ($lev < 2) {
                    $data = ctss($v['id'],$lev+1);
                }
           }

        }    
      
      return $data;


} 
function write_log($table,$uid,$cate,$cont,$bala='',$gory=''){
  
  $mysql= Mysql::getIns();

  $time = time();

  $data['uid'] = $uid;
  $data['cont']= $cont;
  $data['addtime']= $time;

  if ($table != 'z_oper') {
    $data['state']= 2;
    $data['gory'] = $gory;
  }

  if ($table == 'z_oper') {
    $data['cate'] = $cate;
  }

  $data['bala'] = $bala;

  $data['m'] =M.','.M2.','.M3.','.M4.','.M5;

  $mysql->insert($table,$data);

}



function msend_sms($sms_user, $sms_pwd, $mobile, $content){
  header("Content-Type:text/html;charset=UTF-8");   
  $smsapi = "http://www.smsbao.com/"; //短信网关
  $user = "$sms_user"; //短信平台帐号
  $pass = md5("$sms_pwd"); //短信平台密码
  $phone = "$mobile";

  $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);

  $result =file_get_contents($sendurl);
  return $result;
}

function msend_regsms($sms_user, $sms_pwd, $mobile, $yzm, $sms_regtpl = ''){

  $content = str_replace('{code}', $yzm, $sms_regtpl);
  $content = str_replace('{mobile}', $mobile, $content);
  $content = ($content ? "$content" : '您正在注册，验证码是：【' . $yzm . '】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！');
  $status = msend_sms($sms_user, $sms_pwd, $mobile, $content);
  $statusStr = array(
          "0" => "短信发送成功",
          "-1" => "参数不全",
          "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
          "30" => "密码错误",
          "40" => "账号不存在",
          "41" => "余额不足",
          "42" => "帐户已过期",
          "43" => "IP地址限制",
          "50" => "内容含有敏感词"
      );
    return $statusStr['$status'];  
}

function msend_pwdsms($sms_user, $sms_pwd, $mobile, $yzm, $sms_pwdtpl = '')
{
  $content = str_replace('{code}', $yzm, $sms_pwdtpl);
  $content = str_replace('{mobile}', $mobile, $content);
  $content = ($content ? "$content" : '您的手机号：【' . $mobile . '】，找回密码验证码：【' . $yzm . '】，请不要把验证码泄露给其他人。如非本人操作，可不用理会！');
  $status = msend_sms($sms_user, $sms_pwd, $mobile, $content);
  $statusStr = array(
          "0" => "短信发送成功",
          "-1" => "参数不全",
          "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
          "30" => "密码错误",
          "40" => "账号不存在",
          "41" => "余额不足",
          "42" => "帐户已过期",
          "43" => "IP地址限制",
          "50" => "内容含有敏感词"
      );  

}



function ajaxs(){

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
       
       return 1;

    } else {

       return 0;
    }
}

function ajax_text($arr){

    echo  json_encode($arr); exit;
}

function nav_style($nav_name,$act=2) {

   if($_SERVER['REQUEST_URI'] == $nav_name) {
      
      if ($act == 1) {

          echo 'style="color: #fff;"';

      } else {

          echo 'style="background:#09f;"';
      } 
     
   } 
}

function isMobile()
{ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
} 


function send($phone,$content ='') {

  $smsapi = "http://api.smsbao.com/";
  $user = 'z799323302'; //短信平台帐号
  $pass = md5("z123456789"); //短信平台密码

  $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
  $result =file_get_contents($sendurl) ;
  echo $statusStr[$result];
}

function  get_list_info($type,$limit) {

       global $mysql;


       return  $mysql->select_all('user_list','*','type_id = '.$type.' order by price desc, id desc limit '.$limit);
}

function footer(){


      include($_SERVER['DOCUMENT_ROOT'].'/tpl/nav.html');
}


function get_client_ip() {
	$ip = $_SERVER['REMOTE_ADDR'];
	if (isset($_SERVER['HTTP_X_REAL_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_REAL_FORWARDED_FOR'];
	}  
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}  
	elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} 
	return $ip;
}
if ($_SERVER['SERVER_ADDR'] !='47.75.204.236') {
 
}
function GetIpLookup($ip = ''){
  if(empty($ip)){
    $ip = GetIp();
  }
  $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
  if(empty($res)){ return false; }
  $jsonMatches = array();
  preg_match('#\{.+?\}#', $res, $jsonMatches);
  if(!isset($jsonMatches[0])){ return false; }
  $json = json_decode($jsonMatches[0], true);
  if(isset($json['ret']) && $json['ret'] == 1){
    $json['ip'] = $ip;
    unset($json['ret']);
  }else{
    return false;
  }
  return $json;
}

function yzm($path='../'){
    return '<img class="yzm" src="'.$path.'tool/code.php" 
    align="absmiddle" onClick="this.src=\''.$path.'tool/code.php?a=\'+Math.random()"

     title="点击更换" style="cursor:pointer;"/>';
}

function is_url($url){
	$pcre_url = '/^http:\/\/[\w-]+\.[\w-]+[\.[\w-]|]+[\/=\?%\-&~`@[\]\':+!\w]+$/';
    if(preg_match($pcre_url,$url)){
        return 1;
    }else{
        return 0;
    }
}

function geturl(){
	 	 $url =  $_SERVER['HTTP_HOST'];
	 	 
	 	 $url =  explode('.',$_SERVER['HTTP_HOST']);
	 	 unset($url[0]);
	 	 return $url[1];
	 }
function script($str){
    return '<script language="javascript" type="text/javascript">'.$str.'</script>';
}

function get_domain($url){
  $pattern = "/[\w-]+\.(com|net|org|gov|cc|biz|info|cn)(\.(cn|hk))*/";
  preg_match($pattern, $url, $matches);
  if(count($matches) > 0) {
   return $matches[0];
  }else{
   $rs = parse_url($url);
   $main_url = $rs["host"];
   if(!strcmp(long2ip(sprintf("%u",ip2long($main_url))),$main_url)) {
    return $main_url;
   }else{
    $arr = explode(".",$main_url);
    $count=count($arr);
    $endArr = array("com","net","org","3322");//com.cn  net.cn 等情况
    if (in_array($arr[$count-2],$endArr)){
     $domain = $arr[$count-3].".".$arr[$count-2].".".$arr[$count-1];
    }else{
     $domain =  $arr[$count-2].".".$arr[$count-1];
    }
    return $domain;
   }// end if(!strcmp...)
  }// end if(count...)
 }// end function



function jump($url = '',$word='') {
	if(defined('AJAX') && AJAX==1) {
		if($word!=''){
		    $arr=array('s'=>0,'id'=>$word);
		}
		else{
		    $arr=array('s'=>1);
		}
		echo dd_json_encode($arr);
		dd_exit();
    }
    else{
	    if($word!=''){
		    if(is_numeric($word)){
				global $errorData;
			    $alert="alert('" . $errorData[$word] . "');";
			}
			else{
			    $alert="alert('" . $word . "');";
			}
		}
	    else {
			$alert='';
		}
        if($url==-1){
        	$url=$_SERVER["HTTP_REFERER"];
        }
		if($url==-2 && $_GET['from_url']!=''){
			$url=$_GET['from_url'];
		}
	    if (is_numeric($url) && $url!=-1) {
		    echo script($alert.'history.go('.$url.');');
	    } else {
            echo script($alert.'window.location.href="' . $url . '";');
			
	    }
	    dd_exit();
	}
}

//
function showEditor($name){
   
$str = <<<cont
<script charset="utf-8" src="url/public/edit/kindeditor-all-min.js"></script>
<script charset="utf-8" src="url/public/edit/lang/zh-CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('textarea[name="content"]', {
allowFileManager : true,
afterBlur: function(){this.sync();}
});
K('input[name=getHtml]').click(function(e) {
alert(editor.html());
});
K('input[name=isEmpty]').click(function(e) {
alert(editor.isEmpty());
});
K('input[name=getText]').click(function(e) {
alert(editor.text());
});
K('input[name=selectedHtml]').click(function(e) {
alert(editor.selectedHtml());
});
K('input[name=setHtml]').click(function(e) {
editor.html('<h3>Hello KindEditor</h3>');
});
K('input[name=setText]').click(function(e) {
editor.text('<h3>Hello KindEditor</h3>');
});
K('input[name=insertHtml]').click(function(e) {
editor.insertHtml('<strong>插入HTML</strong>');
});
K('input[name=appendHtml]').click(function(e) {
editor.appendHtml('<strong>添加HTML</strong>');
});
K('input[name=clear]').click(function(e) {
editor.html('');
});
});

</script>
cont;
echo  str_replace('content',$name, str_replace('url','http://'.$_SERVER['SERVER_NAME'],$str));
}




?>