<?php

use xh\library\url;
use xh\library\model;

//权限控制
$model = (new model())->load('user', 'authority');
?>
<div class="navigation clearfix">
    <!--<span><?php /*echo WEB_NAME; */ ?> （pay） V <?php /*echo SYSTEM_VERSION; */ ?></span>-->
    <ul class="layui-nav layui-nav-tree" style="width: 100%;">
        <?php foreach ($menu as $m) {
            $module = $mysql->query("mgt_module", "menuid={$m['id']} and state=1");
            //检测该菜单下是否有绑定的模块
            if (is_array($module[0])) {
                ?>
                <li class="layui-nav-item"><a href="javascript:;">
                        <?php echo $m['menu_name']; ?></a>
                    <ul style="" class="layui-nav-child">
                        <?php foreach ($module as $mod) {
                            //检测当前用户组是否有权限访问该模块
                            if ($model->moduleValidate($mod['id'])) {
                                ?>
                                <li><a class="iframe_open" href="javascript:;" data-href="<?php echo url::s($mod['route']); ?>"><?php echo $mod['name']; ?></a></li>
                            <?php }
                        } ?>
                    </ul>
                </li>
            <?php }
        } ?>
    </ul>
    <?php if ($model->superVerification()) { ?>
        <ul class="sidebar-panel">
            <li class="sidetitle">超级权限</li>
            <li>
                <a class="iframe_open" data-href="<?php echo url::s('admin/menu/index'); ?>">
                    <span class="icon color15">
                        <i class="fa fa-cube"></i>
                    </span>菜单管理
                </a>
            </li>
            <li>
                <a class="iframe_open" data-href="<?php echo url::s('admin/module/index'); ?>">
                    <span class="icon color7">
                        <i class="fa fa-puzzle-piece"></i>
                    </span>模块管理</a>
            </li>
            <li>
                <a class="iframe_open" data-href="<?php echo url::s('admin/power/group'); ?>">
                    <span class="icon color7"><i class="fa fa-group"></i>
                    </span>权限管理
                </a>
            </li>
            <li>
                <a class="iframe_open" data-href="<?php echo url::s('admin/employee/index'); ?>">
                    <span class="icon color7">
                        <i class="fa fa-user-md"></i>
                    </span>我的员工
                </a>
            </li>
        </ul>
    <?php } ?>
</div>
