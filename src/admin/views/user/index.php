<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider
 * @var $searchModel
 */

use common\models\enum\UserStatus;
use kriss\widgets\ActionColumn;
use kriss\widgets\DatetimeColumn;
use kriss\widgets\SimpleDynaGrid;
use kriss\widgets\ToggleColumn;
use yii\helpers\Html;

$this->title = '用户列表';
$this->params['breadcrumbs'] = [
    $this->title,
];

echo $this->render('_search', [
    'model' => $searchModel,
]);

$columns = [
    [
        'attribute' => 'id',
    ],
    [
        'attribute' => 'cellphone',
    ],
    [
        'attribute' => 'name',
    ],
    [
        'class' => ToggleColumn::class,
        'attribute' => 'status',
        'action' => 'change-status',
        'items' => UserStatus::getViewItems(),
        'onValue' => UserStatus::NORMAL,
        'offValue' => UserStatus::DISABLE,
    ],
    [
        'class' => DatetimeColumn::class,
        'attribute' => 'created_at',
    ],
    [
        'class' => DatetimeColumn::class,
        'attribute' => 'updated_at',
    ],
    [
        'class' => ActionColumn::class,
        'groupButtons' => [
            ['action' => 'view', 'label' => '详情', 'cssClass' => 'show_ajax_modal',],
            ['action' => 'update', 'label' => '修改', 'type' => 'primary', 'cssClass' => 'show_ajax_modal',],
        ],
    ],
];

echo SimpleDynaGrid::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns,
    'extraToolbar' => [
        [
            'content' => Html::a('新增', ['create'], ['class' => 'btn btn-primary show_ajax_modal'])
        ]
    ],
]);
