<?php
/**
 * Created by JieChengYang.
 * User: JieChengYang
 * Date: 2017/11/3 0003
 * Time: 下午 15:12
 */
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use yii\widgets\ListView;
    use yii\grid\GridView;//在 GridView 小部件是从数据提供者获取数据，并以一个表格的形式呈现数据。表中的每一行代表一个单独的数据项，列表示该项目的属性。
    use yii\helpers\Url;//助手类
    if( isset($model)){
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name:html',
                    [
                        'label' => '电子邮箱',
                        'value' => $model->email
                    ]
                ]
            ]);
    }
    if(isset($dataProvider)){
        if(empty($viewtype)){
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_user',
            ]);
        }elseif($viewtype == 'grid'){
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                ]);
        }elseif($viewtype == 'grid2'){//自定义列
            /*9.修改列表顶部分页信息
            //{begin}：当前列的第一个元素序号
            //{end}：当前页的最后一个元素序号
            //{count}：当前页的元素总数
            //{totalCount}：所有元素总数
            //{page}：当前页
            //{pageCount}：总页数*/
                echo GridView::widget([
                    'layout' => "{items}\n<div style='float: left;'>{pager}</div><div style='text-align: right; float: right;width: 20%;height:79px;line-height: 60px;'>{summary}</div>",
                    'dataProvider' => $dataProvider,
                    'summary' => '第{begin}-{end}页，共计{totalCount}位用户',
                    'columns' => [
                        'id',
                        [
                            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                            'label' => '名字和邮件',
                            'value' => function ($data) {
                                return $data->name . " 的邮箱地址是： " . $data->email;
                            },
                        ],
                        [
                            'label' => '标签图',
                            'format' => [
                                'image',
                                [
                                    'height' =>50,
                                    'width' => 100
                                ]
                            ],
                            'value' => function($model){
                                return $model->label_img;
                            }
                        ],
                        [
                            'attribute' => 'is_valid',
                            'label' => '发布状态',
                            'value' => function($model) {
                                return $model->is_valid == 0 ? '未发布' : '发布';
                            },
                            'filter' => [
                                0 => '未发布',
                                1 => '发布'
                            ]
                        ],
                        'created_at:datetime',
                        [
                            'attribute' => 'content',
                            'label' => '内容过滤',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::encode($model->content);
                            },

                        ],
                    ],
                ]);
        }elseif($viewtype == 'grid3'){//网格列
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'], 'name',
                        //['class' => 'yii\grid\ActionColumn'],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{test} {view} {update} {delete}',
                            'header' => '操作',
                            'buttons' => [
                                'test' => function ($url, $model, $key) {
                                    $url = "user/register/test";
                                    return Html::a('测试按钮', Yii::$app->urlManager->createUrl([$url,'id'=>$key]), ['data-method' => 'post','data-pjax'=>'0'] );
                                },
                                'delete'=> function ($url, $model, $key){
                                    return  Html::a('删除', ['delete', 'id'=>$model->id],[
                                        'data-method'=>'post',              //POST传值
                                        'data-confirm' => '确定删除该项？', //添加确认框
                                    ] ) ;
                                }
                            ],
                        ],
                        ['class' => 'yii\grid\CheckboxColumn'],
                    ],
                ]);
        }
    }

?>