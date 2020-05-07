<?php
return array(
	//'配置项'=>'配置值'
	'VIEW_PATH'		=> './Templet/', //模板位置单独定义	
	'DEFAULT_THEME' => 'wap',     //定义模板主题
	'THEME_LIST' => 'wap', 
	'VIEW_TITLE' => '天天跑分',
	'TMPL_PARSE_STRING'    => array(
		//手机端静态文件
        '__WCSS__'       => __ROOT__ . '/Public/home/wap/css',
        '__WJS__'        => __ROOT__ . '/Public/home/wap/js',
        '__WIMG__'       => __ROOT__ . '/Public/home/wap/images',
        '__WAP__'        => __ROOT__ . '/Public/home/wap',
        '__HOME__'        => __ROOT__ . '/Public/homestyle',
        '__COM__'        => __ROOT__ . '/Public/home/common',
        '__MUSIC__'		 => __ROOT__ . '/Public/music',

        //上传头像
        '__IMGHEAD__'        => __ROOT__ . '/Public/home/wap/heads',
        //头像上传JD
        '__IMGJS__'        => __ROOT__ . '/Public/home/wap/jsa',

        '__LAYERUI__'       => __ROOT__ . '/Public/home/wap/layui',

    ),
);