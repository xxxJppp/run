<?php 

define('ACC', 1);

include('../sys/init.php');

$info = $mysql->select('fafa_renwu','*','id='.$_REQUEST['rid']);



?>
        <link href="./public/css/renwu.css" rel="stylesheet" type="text/css"/>
  
       <style>
   img{
background-size:contain;
width:90%;
height: auto;
margin: 0 auto;
display: block;}
       </style>

        <section class="aui-flexView" id="navHead" style="height:auto">
            <header class="aui-navBar aui-navBar-fixed" id="nav-wrap">
                <a href="javascript:;" class="aui-navBar-item" onclick="location.href='index.dos'">
                    <i class="icon icon-return"></i>
                </a>
                <div class="aui-center">
                    <span class="aui-center-title"><?php echo $info['title']; ?></span>
                </div>
                <a href="javascript:;" class="aui-navBar-item">
                    <i class="icon icon-share"></i>
                </a>
            </header>
            <section class="aui-scrollView">
                <div class="aui-free-gray">
                    <div class="aui-flex">
                        <div class="aui-flex-box">
                            <h2><?php echo $info['title']; ?></h2>
                            <h3>任务佣金: ￥<?php echo $info['money']; ?></h3>
                        </div>
                        <div class="aui-free-user">
                           
                        </div>
                    </div>
                    <div class="aui-info-icon">
                        <span>
                            <i class="icon icon-opt"></i>限时完成
                        </span>
                        <span>
                            <i class="icon icon-opt"></i>截图审核
                        </span>
                    </div>
                </div>
                <div class="aui-flex">
                   
                    <div class="aui-right-time"  style="width: 50%;    text-align: left;">
                        <h2><em>限时</em><?=$info['xianshi']?><em>小时内完成</em></h2>
                        
                    </div>
                    <div class="aui-right-time"  style="width: 50%;    text-align: left;">
                        <h2><em>已有</em><?=$info['snum']?><em>人成功获得佣金</em></h2>
                        
                    </div>
                </div>
                <div class="divHeight"></div>
                <div class="aui-flex">
                    <div class="aui-flex-box">
                        <h1>【任务流程】</h1>
                        <?=$info['txt']?>
                        <h1>【适用人群】</h1>
                        <?=$info['shenhe']?>
                    </div>
                </div>
                <div style="height:60px;"></div>
            </section>
            <footer class="aui-footer-button aui-footer-flex aui-footer-fixed">
              

                <div class="aui-footer-group aui-footer-flex1" id="save">
                    <div class="aui-footer-flex">
                        <div class="aui-btn aui-btn-gray">
                            <h2  >做此任务</h2>
                        </div>
                    </div>
                </div>
            </footer>
        </section>



        <script type="text/javascript">
            $(document).ready(function() {
                var navHeight = $("#navHead").offset().top;
                var navFix = $("#nav-wrap");
                $(window).scroll(function() {
                    if ($(this).scrollTop() > navHeight) {
                        navFix.addClass("aui-flex");
                    } else {
                        navFix.removeClass("aui-flex");
                    }
                })




                $("#save").click(function(){

                      layer.open({
                        content: '您确认要做此任务赚取佣金吗？'
                        ,btn: ['是的', '取消']
                        ,skin: 'footer'
                        ,yes: function(index){
                            $.ajax({
                                type:"POST",
                                url:"r.dos",
                                data:{'id':<?=$_REQUEST['rid']?>},
                                dataType:'json',
                                success:function(data){
                                    if(data.error == 0){
                                         layer.open({
                                            content: '恭喜您已经成功抢到此任务。'
                                            ,btn: ['我的任务', '好的']
                                            ,yes: function(index){
                                                layer.close(index);
                                                 view('task');
                                            }
                                          });
                                    }else{

                                       layer.open({content: data.msg});
                                    }
                                }
                            });
                        }
                      });
                })


            });

            $(document).ready(function() {
                $(".btn-slide").click(function() {
                    $("#show").slideToggle();
                });

               
            });

         
        </script>

