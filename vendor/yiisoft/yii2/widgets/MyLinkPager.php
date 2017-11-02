<?php
namespace yii\widgets;
use Yii;
use yii\widgets\LinkPager;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\base\Widget;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
class MyLinkPager extends LinkPager
{
  public $prevPageLabel = '<i class="fa fa-angle-left"></i>';
  public $nextPageLabel = '<i class="fa fa-angle-right"></i>';
  public $currentCountPageLabel = '第 {currentPage} 页 / 共 {countPage} 页';
  public $currentCountPageClass = 'page-number';
  public $hideOnSinglePage = false;
  public function init () {
    parent::init();
  }
  public function run () {
    $pageCount = $this->pagination->getPageCount();
    if ($pageCount < 2 && $this->hideOnSinglePage) {
      return '';
    }
    $buttons = [];
    $currentPage = $this->pagination->getPage();
    // prev page
    if ($this->prevPageLabel !== false) {
      if (($page = $currentPage - 1) < 0) {
        $page = 0;
      }
      $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
    }
    // current page / count page
    if ($this->currentCountPageLabel !== false && $pageCount) {
      $currentCountPageLabel = str_replace(['{currentPage}', '{countPage}'], [$currentPage+1, $pageCount], $this->currentCountPageLabel);
      $buttons[] = Html::tag('span', $currentCountPageLabel, array('class' => $this->currentCountPageClass));
    }
    // next page
    if ($this->nextPageLabel !== false) {
      if (($page = $currentPage + 1) >= $pageCount - 1) {
        $page = $pageCount - 1;
      }
      $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
    }
    return Html::tag('nav', implode("\n", $buttons), $this->options);
  }
  protected function renderPageButton($label, $page, $class, $disabled, $active)
  {
    $options = ['class' => empty($class) ? $this->pageCssClass : $class];
    if ($active) {
      Html::addCssClass($options, $this->activePageCssClass);
    }
    if ($disabled) {
      return false;
    }
    $linkOptions = $this->linkOptions;
    $linkOptions += $options;
    $linkOptions['data-page'] = $page;
    return Html::a($label, $this->pagination->createUrl($page), $linkOptions);
  }
}