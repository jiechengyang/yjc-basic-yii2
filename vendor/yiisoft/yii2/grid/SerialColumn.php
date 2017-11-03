<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\grid;

/**
 * SerialColumn displays a column of row numbers (1-based).
 * SerialColumn显示行号(基于1)的列。
 * To add a SerialColumn to the [[GridView]], add it to the [[GridView::columns|columns]] configuration as follows:
 * 要将SerialColumn添加到[[GridView]]中，将其添加到[[GridView:columns |列]]配置如下:
 * ```php
 * 'columns' => [
 *     // ...
 *     [
 *         'class' => 'yii\grid\SerialColumn',
 *         // you may configure additional properties here 您可以在这里配置额外的属性
 *     ],
 * ]
 * ```
 *
 * For more details and usage information on SerialColumn, see the [guide article on data widgets](guide:output-data-widgets).
 * 有关SerialColumn的更多详细信息和使用信息，请参阅“数据小部件指南”(guide:output -data widgets)。
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SerialColumn extends Column
{
    /**
     * @inheritdoc
     */
    public $header = '#';


    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $pagination = $this->grid->dataProvider->getPagination();
        if ($pagination !== false) {
            return $pagination->getOffset() + $index + 1;
        } else {
            return $index + 1;
        }
    }
}
