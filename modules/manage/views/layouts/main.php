<?php
use yii\helpers\Html;
use app\assets\AdminAsset;
AdminAsset::register($this);
\app\assets\ConditionAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php AdminAsset::addCss($this,'@web/bjui/B-JUI/themes/css/ie7.css',['condition' => 'lte IE8']);  ?>
    <?php $this->head() ?>
     <!--[if lte IE 7]>
    <link href="bjui/B-JUI/themes/css/ie7.css" rel="stylesheet">
    <![endif]-->
    <script type="text/javascript">
    $(function() {
        BJUI.init({
            JSPATH       : 'B-JUI/',         //[可选]框架路径
            PLUGINPATH   : 'B-JUI/plugins/', //[可选]插件路径
            loginInfo    : {url:'login_timeout.html', title:'登录', width:440, height:240}, // 会话超时后弹出登录对话框
            statusCode   : {ok:200, error:300, timeout:301}, //[可选]
            ajaxTimeout  : 300000, //[可选]全局Ajax请求超时时间(毫秒)
            alertTimeout : 3000,  //[可选]信息提示[info/correct]自动关闭延时(毫秒)
            pageInfo     : {total:'totalRow', pageCurrent:'pageCurrent', pageSize:'pageSize', orderField:'orderField', orderDirection:'orderDirection'}, //[可选]分页参数
            keys         : {statusCode:'statusCode', message:'message'}, //[可选]
            ui           : {
                             sidenavWidth     : 220,
                             showSlidebar     : true, //[可选]左侧导航栏锁定/隐藏
                             overwriteHomeTab : false //[可选]当打开一个未定义id的navtab时，是否可以覆盖主navtab(我的主页)
                           },
            debug        : true,    // [可选]调试模式 [true|false，默认false]
            theme        : 'green' // 若有Cookie['bjui_theme'],优先选择Cookie['bjui_theme']。皮肤[五种皮肤:default, orange, purple, blue, red, green]
        })
        //时钟
        var today = new Date(), time = today.getTime()
        $('#bjui-date').html(today.formatDate('yyyy/MM/dd'))
        setInterval(function() {
            today = new Date(today.setSeconds(today.getSeconds() + 1))
            $('#bjui-clock').html(today.formatDate('HH:mm:ss'))
        }, 1000)
    })
    
    /*window.onbeforeunload = function(){
        return "确定要关闭本系统 ?";
    }*/
    
    //菜单-事件-zTree
    function MainMenuClick(event, treeId, treeNode) {
        if (treeNode.target && treeNode.target == 'dialog' || treeNode.target == 'navtab')
            event.preventDefault()
        
        if (treeNode.isParent) {
            var zTree = $.fn.zTree.getZTreeObj(treeId)
            
            zTree.expandNode(treeNode)
            return
        }
        
        if (treeNode.target && treeNode.target == 'dialog')
            $(event.target).dialog({id:treeNode.targetid, url:treeNode.url, title:treeNode.name})
        else if (treeNode.target && treeNode.target == 'navtab')
            $(event.target).navtab({id:treeNode.targetid, url:treeNode.url, title:treeNode.name, fresh:treeNode.fresh, external:treeNode.external})
    }
    
    // 满屏开关
    var bjui_index_container = 'container_fluid'
    
    function bjui_index_exchange() {
        bjui_index_container = bjui_index_container == 'container_fluid' ? 'container' : 'container_fluid'
        
        $('#bjui-top').find('> div').attr('class', bjui_index_container)
        $('#bjui-navbar').find('> div').attr('class', bjui_index_container)
        $('#bjui-body-box').find('> div').attr('class', bjui_index_container)
    }
    </script>
</head>
<?php $this->beginBody() ?>
<body>
    <!--[if lte IE 7]>
        <div id="errorie"><div>您还在使用老掉牙的IE，正常使用系统前请升级您的浏览器到 IE8以上版本 <a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/ie-8-worldwide-languages">点击升级</a>&nbsp;&nbsp;强烈建议您更改换浏览器：<a href="http://down.tech.sina.com.cn/content/40975.html" target="_blank">谷歌 Chrome</a></div></div>
    <![endif]-->
    <div id="bjui-top" class="bjui-header">
        <div class="container_fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapsenavbar" data-target="#bjui-top-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <nav class="collapse navbar-collapse" id="bjui-top-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="datetime"><a><span id="bjui-date">0000/00/00</span> <span id="bjui-clock">00:00:00</span></a></li>
                    <li><a href="#">账号：BJUI</a></li>
                    <li><a href="#">角色：管理员</a></li>
                    <li><a href="changepassword.html" data-toggle="dialog" data-id="sys_user_changepass" data-mask="true" data-width="400" data-height="300">修改密码</a></li>
                    <li><a href="login.html" style="font-weight:bold;">&nbsp;<i class="fa fa-power-off"></i> 注销登陆</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle bjui-fonts-tit" data-toggle="dropdown" title="更改字号"><i class="fa fa-font"></i> 大</a>
                        <ul class="dropdown-menu" role="menu" id="bjui-fonts">
                            <li><a href="javascript:;" class="bjui-font-a" data-toggle="fonts"><i class="fa fa-font"></i> 特大</a></li>
                            <li><a href="javascript:;" class="bjui-font-b" data-toggle="fonts"><i class="fa fa-font"></i> 大</a></li>
                            <li><a href="javascript:;" class="bjui-font-c" data-toggle="fonts"><i class="fa fa-font"></i> 中</a></li>
                            <li><a href="javascript:;" class="bjui-font-d" data-toggle="fonts"><i class="fa fa-font"></i> 小</a></li>
                        </ul>
                    </li>
                    <li class="dropdown active"><a href="#" class="dropdown-toggle theme" data-toggle="dropdown" title="切换皮肤"><i class="fa fa-tree"></i></a>
                        <ul class="dropdown-menu" role="menu" id="bjui-themes">
                            <!--
                            <li><a href="javascript:;" class="theme_default" data-toggle="theme" data-theme="default">&nbsp;<i class="fa fa-tree"></i> 黑白分明&nbsp;&nbsp;</a></li>
                            <li><a href="javascript:;" class="theme_orange" data-toggle="theme" data-theme="orange">&nbsp;<i class="fa fa-tree"></i> 橘子红了</a></li>
                            -->
                            <li><a href="javascript:;" class="theme_purple" data-toggle="theme" data-theme="purple">&nbsp;<i class="fa fa-tree"></i> 紫罗兰</a></li>
                            <li class="active"><a href="javascript:;" class="theme_blue" data-toggle="theme" data-theme="blue">&nbsp;<i class="fa fa-tree"></i> 天空蓝</a></li>
                            <li><a href="javascript:;" class="theme_green" data-toggle="theme" data-theme="green">&nbsp;<i class="fa fa-tree"></i> 绿草如茵</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:;" onclick="bjui_index_exchange()" title="横向收缩/充满屏幕"><i class="fa fa-exchange"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <header class="navbar bjui-header" id="bjui-navbar">
        <div class="container_fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" id="bjui-navbar-collapsebtn" data-toggle="collapsenavbar" data-target="#bjui-navbar-collapse" aria-expanded="false">
                    <i class="fa fa-angle-double-right"></i>
                </button>
                <a class="navbar-brand" href="http://b-jui.com"><img src="images/logo.png" height="30"></a>
            </div>
            <nav class="collapse navbar-collapse" id="bjui-navbar-collapse">
                <ul class="nav navbar-nav navbar-right" id="bjui-hnav-navbar">
                    <li class="active">
                        <a href="bjui/json/menu-form.json?>" data-toggle="sidenav" data-id-key="targetid">表单相关</a>
                    </li>
                    <li>
                        <a href="bjui/json/menu-base.json" data-toggle="sidenav" data-id-key="targetid">基础组件</a>
                    </li>
                    <li>
                        <a href="bjui/json/menu-datagrid.json" data-toggle="sidenav" data-id-key="targetid">数据表格(Datagrid)</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="sidenav" data-tree="true" data-tree-options="{onClick:MainMenuClick}" data-id-key="targetid">待续……</a>
                        <script class="items"></script>
                    </li>
                    <li>
                        <a href="1.2" target="_blank">旧版DEMO</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div id="bjui-body-box">
        <?=$content;?>
    </div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <?=Html::jsFile('@web/bjui/B-JUI/other/ie10-viewport-bug-workaround.js')?>
</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage()?>