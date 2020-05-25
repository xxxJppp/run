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
            $data = $mysql->query('config',"`key`='{$key}'")[0];
            if(is_array($data)){
                return  $data['value'];
            }else{
                return  false;
            }
        }else{
            return false;
        }

    }

    /**
     * 新增配置信息
     * @ 配置名称 $name 配置数据 $data = ['键'=>'值','键'=>'键']
     * @param array $Cog
     */
    public function addConfig($name,$data)
    {
        $mysql = new mysql();
        //写入数据库
        if($name && $data){
            $info = $mysql->query('config',"`key`='{$name}'")[0];
            if(is_array($info)){
                return ['code'=>2,'msg'=>'配置已经存在'];
            }else{
                if(is_array($data)){
                    $data = json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                }
                $data = [
                    '`key`'=> $name,
                    '`value`'=> $data,
                    'status'=> 1,
                    'create_time'=> time(),
                    'edit_time'=> 0,
                    'catalog'=> 0,
                ];
                //插入
                $re = $mysql->insert("config", $data);
                if(!$re){
                    return ['code'=>2,'msg'=>'增加失敗'];
                }
                return ['code'=>1,'msg'=>'成功'];
            }
        }else{
            return ['code'=>2,'msg'=>'缺少参数'];
        }

    }

    /**
     * 更改配置信息
     * @param string $name
     * @param array $Cog
     */
    public function updateConfig($name,$data){
        $mysql = new mysql();
        //写入数据库
        if($name && $data){
            $info = $mysql->query('config',"`key`='{$name}'")[0];
            if(is_array($info)){
                if(is_array($data)){
                    $data = json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                }
                $data = [
                    '`key`'=> $name,
                    '`value`'=> $data,
                    'status'=> 1,
                    'edit_time'=> time(),
                    'catalog'=> 0,
                ];
                //更改
                $re = $mysql->update("config",$data);
                if(!$re){
                    return ['code'=>2,'msg'=>'更改失敗'];
                }
                return ['code'=>1,'msg'=>'成功'];
            }else{
                return ['code'=>2,'msg'=>'配置不存在'];
            }
        }else{
            return ['code'=>2,'msg'=>'缺少参数'];
        }
    }

    /**
     * 删除配置信息
     * @param string $name
     * @param array $Cog
     */
    public function delConfig($name){
        $mysql = new mysql();
        //写入数据库
        if($name){
            $info = $mysql->query('config',"`key`='{$name}'")[0];
            if(is_array($info)){
                //删除
                $re = $mysql->delete("city", "`key`='{$name}'");
                if(!$re){
                    return ['code'=>2,'msg'=>'删除失敗'];
                }
                return ['code'=>1,'msg'=>'成功'];
            }else{
                return ['code'=>2,'msg'=>'配置不存在'];
            }
        }else{
            return ['code'=>2,'msg'=>'缺少参数'];
        }
    }

}