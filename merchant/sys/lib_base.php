<?php

defined('ACC')||exit('ACC Denied');


function _addslashes($arr) {
    foreach($arr as $k=>$v) {
        if(is_string($v)) {
            $arr[$k] = addslashes($v);
        } else if(is_array($v)) {  
            $arr[$k] = _addslashes($v);
        }
    }
    
    return $arr;
}
/*
if(count($_GET)>0)
{
  
    $_SESSION['HTTP_REFERER']=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"";
    function CheckURL()
    {
        
        if($_SESSION['HTTP_REFERER']=="")
        {
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo "<script>";
            echo "alert('参数不正确');";
            echo "window.location.href='/';";
            echo "</script>";
            exit;
        }
    }
    CheckURL();
}
*/
 if (get_magic_quotes_gpc()) {
	$_GET = stripslashes_array($_GET);
	$_POST = stripslashes_array($_POST);
}
 
function stripslashes_array(&$array) {
while(list($key,$var) = each($array)) {
if ($key != 'argc' && $key != 'argv' && (strtoupper($key) != $key || ''.intval($key) == "$key")) {
if (is_string($var)) {
$array[$key] = stripslashes($var);
}
if (is_array($var))  {
$array[$key] = stripslashes_array($var);
}
}
}
return $array;
}
     

function lib_replace_end_tag($str)
{
if (empty($str)) return false;
$str = htmlspecialchars($str);
$str = str_replace( '/', "", $str);
$str = str_replace("\\", "", $str);
$str = str_replace(">", "", $str);
$str = str_replace("<", "", $str);
$str = str_replace("<SCRIPT>", "", $str);
$str = str_replace("</SCRIPT>", "", $str);
$str = str_replace("<script>", "", $str);
$str = str_replace("</script>", "", $str);
$str=str_replace("select","select",$str);
$str=str_replace("join","join",$str);
$str=str_replace("union","union",$str);
$str=str_replace("where","where",$str);
$str=str_replace("insert","insert",$str);
$str=str_replace("delete","delete",$str);
$str=str_replace("update","update",$str);
$str=str_replace("like","like",$str);
$str=str_replace("drop","drop",$str);
$str=str_replace("create","create",$str);
$str=str_replace("modify","modify",$str);
$str=str_replace("rename","rename",$str);
$str=str_replace("alter","alter",$str);
$str=str_replace("cas","cast",$str);
$str=str_replace("&","&",$str);
$str=str_replace(">",">",$str);
$str=str_replace("<","<",$str);
$str=str_replace(" ",chr(32),$str);
$str=str_replace(" ",chr(9),$str);
$str=str_replace("    ",chr(9),$str);
$str=str_replace("&",chr(34),$str);
$str=str_replace("'",chr(39),$str);
$str=str_replace("<br />",chr(13),$str);
$str=str_replace("''","'",$str);
$str=str_replace("css","'",$str);
$str=str_replace("CSS","'",$str);
 
return $str;
 
}

function getTree($data, $pId)
{
$tree = '';
foreach($data as $k => $v)
{
   if($v['cate_ParentId'] == $pId)
   {         //父亲找到儿子
    $v['cate_ParentId'] = getTree($data, $v['cate_Id']);
    $tree[] = $v;
    //unset($data[$k]);
   }
}
return $tree;
}
?>
