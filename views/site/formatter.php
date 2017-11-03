<?php
    $formatter = \Yii::$app->formatter;
    echo $formatter->asDate('2017-10-17','long'),'<br/>';
    // output: January 1, 2016
    echo $formatter->asDate('2019-10-01', 'long'),"<br>";
    // output: 51.50%
    echo $formatter->asPercent(0.515, 2),"<br>";
    // output: <a href = "mailto:yiibai.com@gmail.com">yiibai.com@gmail.com</a>
    echo $formatter->asEmail('yiiibai.com@gmail.com'),"<br>";
    // output: Yes
    echo $formatter->asBoolean(true),"<br>";
    // output: (Not set)
    echo $formatter->asDate(null),"<br>";
    echo $formatter->asTime(date("Y-m-d")),"<br>";
    echo $formatter->asDatetime(date("Y-m-d")),"<br>";
    echo $formatter->asTimestamp(date("Y-m-d")),"<br>";
    echo $formatter->asRelativeTime(date("Y-m-d")),"<br>";
    echo $formatter->asDate(date('Y-m-d'), 'short'),"<br>";
    echo $formatter->asDate(date('Y-m-d'), 'medium'),"<br>";
    echo $formatter->asDate(date('Y-m-d'), 'long'),"<br>";
    echo $formatter->asDate(date('Y-m-d'), 'full'),"<br>";
    echo $formatter->asInteger(105),"<br>";
    echo $formatter->asDecimal(105.41),"<br>";
    echo $formatter->asPercent(0.51),"<br>";
    echo $formatter->asScientific(105),"<br>";
    //echo $formatter->asCurrency(105),"<br>";
    echo $formatter->asSize(105),"<br>";
    echo $formatter->asShortSize(105),"<br>";
?>