<?php 
    use yii\helpers\Url;
?>
<div class="site-about">
    <h4>
        creates a URL to a route: /index.php?r = post/index
        <b>Url::to(['post/index'])</b>
        <?=Url::to(['post/index'])?>
    </h4>
    <h4>
        creates a URL to a route with parameters: /index.php?r = post/view&id=100
        <b>Url::to(['post/view','id'=>100])</b>
        <?=Url::to(['post/view','id' => 100])?>
    </h4>
    <h4>
      creates an anchored URL: /index.php?r = post/view&id=100#content
      <b>Url::to(['post/view','id' => 100,'#' => 'content'])</b>
      <?=Url::to(['post/view','id' => 100,'#' => 'content'])?>
    </h4>
    <h4>
     creates an absolute URL: http://www.example.com/index.php?r=post/index
      <b>Url::to(['post/index'],true)</b>
      <?=Url::to(['post/index'],true)?>
    </h4>
    <h4>
    creates an absolute URL using the https scheme: https://www.example.com/index.php?r=post/index
      <b>Url::to(['post/index'],'https')</b>
      <?=Url::to(['post/index','https'])?>
    </h4>
</div>
<div>

<h4>
   <b>// home page URL: /index.php?r=site/index:Url::home():</b>
   <?php
      
      echo Url::home();
   ?>
</h4>
 
<h4>
   <b>// the base URL, useful if the application is deployed in a sub-folder of the Web root:Url::base():</b>
   <?php
      
      echo Url::base();
   ?>
</h4>
 
<h4>
   <b>      // the canonical URL of the currently requested URL
      // see https://en.wikipedia.org/wiki/Canonical_link_element:Url::canonical():</b>
   <?php

      echo Url::canonical();
   ?>
</h4>
 
<h4>
   <b> remember the currently requested URL and retrieve it back in later requests:Url::previous():</b>
   <?php
     
      Url::remember();
      echo Url::previous();
   ?>
</h4>
</div>

