<?php

defined('ACC')||exit('ACC Denied');
class mysql extends db {
    private static $ins = NULL;
    private $conn = NULL;
    private $conf = array();
    const   BIAOTOU ='';
    

    protected function __construct() {
        $this->conf = conf::getIns();

        $this->connect($this->conf->host,$this->conf->user,$this->conf->pwd);
        $this->select_db($this->conf->db);
        $this->setChar($this->conf->char);
    }


    public function __destruct() {
    }

    public static function getIns() {
        if(!(self::$ins instanceof self)) {
            self::$ins = new self();
        }

        return self::$ins;
    }

    public function connect($h,$u,$p) {
        $this->conn = mysql_connect($h,$u,$p);
        if(!$this->conn) {
            $err = new Exception('连接失败');
            throw $err;
        }
    }

    protected function select_db($db) {
        $sql = 'use ' . $db;
        $this->query($sql);
    }

    protected function setChar($char) {
        $sql = 'set names ' . $char;
        return $this->query($sql);
    }

    public function query($sql) {

        $rs = mysql_query($sql,$this->conn);

       

        return $rs;
    }

    public function autoExecute($table,$arr,$mode='insert',$where = ' where 1 limit 1') {
     
        if(!is_array($arr)) {
            return false;
        }

        if($mode == 'update') {
            $sql = 'update ' . $table .' set ';
            foreach($arr as $k=>$v) {
                $sql .= $k . "='" . $v ."',";
            }
            $sql = rtrim($sql,',');
            $sql .= $where;
            
            return $sql; exit;$this->query($sql);
        }

        $sql = 'insert into ' . $table . ' (' . implode(',',array_keys($arr)) . ')';
        $sql .= ' values (\'';
        $sql .= implode("','",array_values($arr));
        $sql .= '\')';

        return $this->query($sql);
    
    }

    public function getAll($sql) {
        $rs = $this->query($sql);
        
        $list = array();
        while($row = mysql_fetch_assoc($rs)) {
            $list[] = $row;
        }

        return $list;
    }

    public function getRow($sql) {
        $rs = $this->query($sql);
        
        return mysql_fetch_assoc($rs);
    }

    public function getOne($sql) {
        $rs = $this->query($sql);
        $row = mysql_fetch_row($rs);

        return $row[0];
    }
   public function affected_rows() {
        return mysql_affected_rows($this->conn);
    }

    public function insert_id() {
        return mysql_insert_id($this->conn);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////


    function free_result(&$query){
        $re=mysql_free_result($query);
        /*if($re!=1){
            print_r(debug_backtrace());
            exit;
        }*/
    }


        function select2arr($sql,$x=0) {
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $arr[] = $row;
        }
        if($x==0){
            $re = $arr;
        }
        else{
            $re = $arr[0];
        }
        $this->free_result($query);
        if(!is_array($re)){$re=array();}
        return $re;
    }

    function select($table, $sel_field, $where='1', $alert = 0) {
        $arr='';

        if(strstr($table,',')!=''){
            $table=str_replace(',',','.$this->BIAOTOU,$table);
        }
        $sql = "select $sel_field from "   . $table . " where $where limit 1";
        if ($alert == 1) {
            echo $sql;
        }
        $query = $this->query($sql);
        if ($query!='') {
            while ($row = $this->fetch_array($query)) {
                if(strpos($sel_field, ",")!==false or strpos($sel_field, "*")!==false) {
                    $arr = $row;
                } 
                else{
                    $arr = array_pop($row);
                }
            }
            $this->free_result($query);
        }
        return $arr;
    }
        function fetch_array($query, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($query, $result_type);
    }
    function select_limit($table, $sel_field, $where='1',$limit='1', $alert = 0) {
        $arr='';

        if(strstr($table,',')!=''){
            $table=str_replace(',',','.$this->BIAOTOU,$table);
        }
        $sql = "select $sel_field from "   . $table . " where $where limit ".$limit;
        if ($alert == 1) {
            echo $sql;
        }
        $query = $this->query($sql);
        if ($query!='') {
            while ($row = $this->fetch_array($query)) {
                if(strpos($sel_field, ",")!==false or strpos($sel_field, "*")!==false) {
                    $arr = $row;
                } 
                else{
                    $arr = array_pop($row);
                }
            }
            $this->free_result($query);
        }
        return $arr;
    }
    
    function select_all($table, $sel_field, $where='1=1', $alert = 0) {
        $arr = array ();
        if(strstr($table,',')!=''){
            $table=str_replace(',',','.$this->BIAOTOU,$table);
        }
        $sql = "select $sel_field from ".$this->BIAOTOU.$table." where $where ";
        if ($alert == 1) {
            echo $sql;
        }
        $query = $this->query($sql);
        if ($query!='') {
            while ($row = $this->fetch_array($query)) {
                $arr[] = $row;
            }
            $this->free_result($query);
        }
        return $arr;
    }
    
    function select_all_key($table, $sel_field, $where='1=1', $key='id', $alert = 0) {
        $arr = array ();
        if(strstr($table,',')!=''){
            $table=str_replace(',',','.$this->BIAOTOU,$table);
        }
        $sql = "select $sel_field from ".$this->BIAOTOU.$table." where $where ";
        if ($alert == 1) {
            echo $sql;
        }
        $query = $this->query($sql);
        if ($query!='') {
            while ($row = $this->fetch_array($query)) {
                $arr[$row[$key]] = $row;
            }
            $this->free_result($query);
        }
        return $arr;
    }
    
    function select_1_field($table, $sel_field='title', $where='1=1', $alert = 0) { //1个字段，输出一维数组
        $sql = "select $sel_field from ".$this->BIAOTOU.$table." where $where ";
        if ($alert == 1) {
            echo $sql;
        }
        $query = $this->query($sql);
        if ($query!='') {
            while ($row = $this->fetch_array($query,MYSQL_NUM)) {
                $arr[] = $row[0];
            }
            $this->free_result($query);
        }
        return $arr[0];
    }
    
    function select_2_field($table, $sel_field='id,title', $where='1=1', $alert = 0) { //2个字段，输出一维数组，第一个字段是键名，第二个字段是键值
        $sql = "select $sel_field from ".$this->BIAOTOU.$table." where $where ";
        if ($alert == 1) {
            echo $sql;
        }
        $query = $this->query($sql);
        if ($query!='') {
            while ($row = $this->fetch_array($query,MYSQL_NUM)) {
                $arr[$row[0]] = $row[1];
            }
            $this->free_result($query);
        }
        return $arr;
    }
    
    function select_3_field($table, $sel_field='id,title,content', $where='1=1', $alert = 0) { //3个字段，输出二维数组，第一个字段是键名，第二，三组成数字作为子数组
        $field_arr=explode(',',$sel_field);
        $sql = "select $sel_field from ".$this->BIAOTOU.$table." where $where ";
        if ($alert == 1) {
            echo $sql;
        }
        $query = $this->query($sql);
        if ($query!='') {
            while ($row = $this->fetch_array($query)) {
                $arr[$row[$field_arr[0]]] = array($field_arr[1]=>$row[$field_arr[1]],$field_arr[2]=>$row[$field_arr[2]]);
            }
            $this->free_result($query);
        }
        return $arr;
    }
    
    function update($table, $set_con_arr, $where,$limit=1,$alert = 0) {
        $set = '';
        if (!array_key_exists(0,$set_con_arr)) {
            $set_arr[0] = $set_con_arr;
        } else {
            $set_arr = $set_con_arr;


        }

        if(!array_key_exists('f',$set_arr[0])){
            foreach ($set_arr[0] as $k => $v) {

                $set = "`$k`='$v'," . $set;
            }
            $set = substr($set, 0, strlen($set) - 1);
        }
        else{
            foreach ($set_arr as $k => $v) {
                if (!isset($v['e']) || $v['e'] == '' || $v['e']=='=') {
                    $temp[] = "`" . $v['f'] . "`='" . $v['v'] . "'";
                } else {
                    $temp[] = "`" . $v['f'] . "`=`" . $v['f'] . "`" . $v['e'] . "'" . $v['v'] . "'";
                }
            }
            $set = implode(',', $temp);
        }
        if($limit==0){
            $limit='';
        }
        elseif($limit>0){
            $limit=' limit '.$limit;
        }
        $sql = "update "   . $table . " set " . $set . " where " . $where . $limit;
        if ($alert == 0) {
            $this->query($sql);
            return $set_arr;
        }
        elseif ($alert == 1) {
            $this->query($sql);
            echo $sql;
        }
    }
    

    
    function insert($table, $field_arr, $alert = 0) {
        $s='';
        foreach ($field_arr as $k => $v) {
            $s.="`" . $k . "`="."'" . $v . "',";
        }
        $s=preg_replace('/,$/','',$s);
        $sql = 'insert into '.$table.' set '.$s;
        $query = $this->query($sql);
        if ($query!=''){
            $re = $this->insert_id();
        }
        
        if ($alert == 1) {
            echo $sql . "<br/>";
        }
        return $re;
    }

    function count($table,$where='',$alert=0){
        if($where!=''){$where ='where '.$where;}
        if(strpos($table,',')!==false){
            $table=str_replace(',',','.$this->BIAOTOU,$table);
        }
        $sql='select count(1) as num from '.$table." ".$where;
        if($alert==1){
            echo $sql;
        }
        $query = $this->query($sql);
        if($query){
            $row=$this->fetch_array($query);
            $this->free_result($query);
        }
        return $row['num']?$row['num']:0;
    }
    
    function count_orther($table,$where='',$alert=0){
        if($where!=''){$where ='where '.$where;}
        if(strpos($table,',')!==false){
            $table=str_replace(',',',',$table);
        }
        $sql='select count(1) as num from '.$table." ".$where;
        if($alert==1){
            echo $sql;
        }
        $query = $this->query($sql);
        $row=$this->fetch_array($query);
        $this->free_result($query);
        return $row['num']?$row['num']:0;
    }
    
    function sum($table,$count_field,$where='1=1',$alert=0){
        if($where!=''){$where ='where '.$where;}
        if(strpos($table,',')!==false){
            $table=str_replace(',',','.$this->BIAOTOU,$table);
        }
        $select_field='';
        if(strpos($count_field,',')!==false){
            $field_arr=explode(',',$count_field);
            foreach($field_arr as $k=>$v){
                $select_field.='sum(`'.$v.'`) as `'.$v.'`,';
            }
            $select_field=preg_replace('/,$/','',$select_field);
        }
        else{
            $select_field='sum('.$count_field.') as sum';
        }
        $sql="select ".$select_field." from ".$this->BIAOTOU.$table." ".$where;
        if($alert==1){echo $sql.'<br/>';}
        $query = $this->query($sql);
        if($query){
            $row=$this->fetch_array($query);
            $this->free_result($query);
            if(count($row)==1){
                return $row['sum']?round($row['sum'],2):0;
            }
            else{
                foreach($row as $k=>$v){
                    $row[$k]=(float)$v;
                }
                return $row;
            }
        }
        return 0;
    }
    
    function delete($table,$where,$alert=0){
        $sql="delete from ".$this->BIAOTOU.$table." where $where";
        $query = $this->query($sql);
        if($alert==1){
            echo $sql;
        }
        if($query!=''){return 1;}
        else{return mysql_error();}
    }
    
    function delete_id_in($ids,$table=MOD,$alert=0){
        $where="id IN(".$ids.")";
        $re=$this->delete($table,$where,$alert=0);
        return $re;
    }
    

}
