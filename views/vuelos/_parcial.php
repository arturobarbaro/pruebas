<?php
use yii\grid\GridView;
?>

 <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'origen_id',
        'destino_id',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
