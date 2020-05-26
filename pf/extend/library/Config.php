<?php
namespace xh\library;

use xh\library\mysql;

class Config
{
    /**
     * 查询配置信息
     * @ 配置名称 $key
     * @param array $Cog
     */
    public static function get($key)
    {
        $mysql = new mysql();
        //查询数据库
        if($key){
            $data = $mysql->query('config',"cfg_key='{$key}'")[0];
            if(is_array($data)){
                return  $data['cfg_value'];
            }else{
                return  false;
            }
        }else{
            return false;
        }
    }

}