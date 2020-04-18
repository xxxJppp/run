<?php 
if(isset($_GET['txt'])) {
  
   $txt = $_GET['txt'];
  
   if($txt == '') {
       $uid = $_SESSION['h_id'];
   }
   
   $info =  $mysql->select('fafa_member','id as uid,pid', ' name = '."'$txt'" );
   
   if($info['pid']!=$_SESSION['h_id']){
      
      $uid = $_SESSION['h_id'];
     
      $list = $mysql->select_all('fafa_member','id as uid ,pid,name,addtime' ,' pid  > '.($_SESSION['h_id']));
     
   } else {
     
      $uid   =$info['uid'];
     
      $list = $mysql->select_all('fafa_member','id as uid ,pid,name,addtime','uid =  '.($uid).' or pid  > '.($uid));
   }
   
   
  
} else {
     $list = $mysql->select_all('fafa_member','id as uid ,pid,name,addtime',' pid  > '.($_SESSION['h_id']-1));
     $uid = $_SESSION['h_id'];
}



// print_r($list);exit();

$tree = array();  
//第一步，将分类id作为数组key,并创建children单元  
foreach($list as $category){  
    $tree[$category['uid']] = $category;  
    $tree[$category['uid']]['children'] = array();  
}  
//第二步，利用引用，将每个分类添加到父类children数组中，这样一次遍历即可形成树形结构。
$i =  0; 
foreach($tree as $key=>$item){  
    if($item['pid'] != 0){  
        
        $tree[$item['pid']]['children'][] = &$tree[$key];//注意：此处必须传引用否则结果不对  
        if($tree[$key]['children'] == null){  
            unset($tree[$key]['children']); //如果children为空，则删除该children元素（可选）  
        }  
    }  
}  
////第三步，删除无用的非根节点数据  
foreach($tree as $key=>$category){  
    if($category['pid'] != 0){  
        unset($tree[$key]);  
    }  
}  

?>