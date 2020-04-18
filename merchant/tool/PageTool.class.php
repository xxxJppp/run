<?php


defined('ACC')||exit('Acc Denied');

class PageTool {
    protected $total = 0;
    protected $perpage = 10;
    protected $page = 9;
    

    public function __construct($total,$page=false,$perpage=false) {
        $this->total = $total;
        if($perpage) {
            $this->perpage = $perpage;
        }

        if($page) {
            $this->page = $page;
        }
    }


    // 主要函数,创建分页导航
    public function show() {
        $cnt = ceil($this->total/$this->perpage);  // 得到总页数
        $uri = $_SERVER['REQUEST_URI'];

        $parse = parse_url($uri);
        


        $param = array();
        if(isset($parse['query'])) {
            parse_str($parse['query'],$param);
        }

        // 不管$param数组里,有没有page单元,都unset一下,确保没有page单元,
        // 即保存除page之外的所有单元
        unset($param['page']);
        
        $url = $parse['path'] . '?';
        if(!empty($param)) {
            $param = http_build_query($param);
            $url = $url . $param . '&';
        }
        
        
       
        $nav = array();
        $nav[0] = '<span class="page_now">' . $this->page . '</span>';


               
        for($left = $this->page-1,$right=$this->page+1;($left>=1||$right<=$cnt)&&count($nav) <= 5;) {
            
            if($left >= 1) {
                array_unshift($nav,'<a  id="aa" href="' . $url . 'page=' . $left . '">' . $left . '</a>');
                $left -= 1;
            }
            
            if($right <= $cnt) {
                array_push($nav,'<a  id="aa" href="' . $url . 'page=' . $right . '">' . $right . '</a>');
                $right += 1;
            }
        }

       

        return implode('',$nav);

    }

}



/*

分页类调用测试

new pagetool(总条数,当前页,每页条数);

show() 返回分页代码.

$page = $_GET['page']?$_GET['page']:1;

$p = new PageTool(20,$page,6);
echo $p->show();


*/
