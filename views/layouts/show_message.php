<?php
	use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>跳转提示</title>
        <style type="text/css">
        *{ padding: 0; margin: 0; }
        body{ font-family: '微软雅黑'; color: #333; font-size: 16px; }
        .system-message{ width:500px; margin:auto;border:6px solid #999;text-align:center; position:relative;top:50%;left:50%;margin-left:-250px;background-color:#FFF;}
        .system-message legend{font-size:24px;font-weight:bold;color:#999;margin:auto;width:100px;}
        .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
        .system-message .jump{ padding-right:10px;height:25px;line-height:25px;font-size:14px;position:absolute;bottom:0px;left:0px;background-color:#e6e6e1 ; display:block;width:490px;text-align:right;}
        .system-message .jump a{ color: #333;}
        .system-message .success,.system-message .error{ line-height: 1.8em; font-size: 15px }
        .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
        </style>
    </head>
    <body>
        <fieldset class="system-message">
            <legend><?php echo
        $title;?></legend>
            <div style="text-align:left;padding-left:10px;height:75px;width:490px;  ">
                <?php if($type==1):?>
                <p class="success"><?=$msg?></p>
                <?php else:?>
                <p class="error"><?=$msg?></p>
                <?php endif;?>
                <p class="detail"></p>
            </div>
            <p class="jump">
                页面自动 <a id="href"
        href="<?=$jumpurl?>">跳转</a> 等待时间： <b id="wait"><?=$wait?></b>
            </p>
        </fieldset>
        <script type="text/javascript">
        (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var totaltime=parseInt(wait.innerHTML);
        var interval = setInterval(function(){
        var time = --totaltime;
        wait.innerHTML=""+time;
        if(time === 0) {
            window.location.href = href;
            clearInterval(interval);
        };
        },1000);
        })();
        </script>
    </body>
</html>