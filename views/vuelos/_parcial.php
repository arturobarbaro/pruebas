<?php
use yii\grid\GridView;

use yii\helpers\Html;
?>

 <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'origen_id',
        'destino_id',
        'salida',
        'llegada',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {ban}',
            'buttons' => [
                'ban' => function ($url, $model, $key) {
                    return Html::a(
                        'Retrasar',
                        ['vuelos/retrasar', 'id' => $model->id],
                        [
                            'data-method' => 'POST',
                            'data-confirm' => '¿Seguro que desea retrasar la salida?'
                        ]);
                    },
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        'Adelantar',
                        ['vuelos/adelantar', 'id' => $model->id],
                        [
                            'data-method' => 'POST',
                        ]);
                    },
                ],
            ],
        ],
]); ?>
