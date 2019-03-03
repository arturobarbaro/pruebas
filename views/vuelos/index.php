<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\controllers\VuelosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vuelos';
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to(['vuelos/buscar-ajax']);
$js = <<<EOT
    $('.categorias-search *').keyup(function (ev) {
        ev.preventDefault();
        var data = $('#w0').serialize();
        $.ajax({
            url: '$url',
            data: data,
            success: function (data) {
                $('#rejilla').html(data);
            },
            error: function (a, b, c) {
                alert('Error');
            }
        });
    });
EOT;
$this->registerJs($js);
?>
<div class="vuelos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="categorias-search">

         <?php $form = ActiveForm::begin([
            'action' => ['buscar-ajax'],
            'method' => 'get',
        ]); ?>

             <?= $form->field($searchModel, 'id') ?>
            <?= $form->field($searchModel, 'origen_id') ?>
            <?= $form->field($searchModel, 'destino_id') ?>

             <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
            </div>

         <?php ActiveForm::end(); ?>
    </div>

    <p>
        <?= Html::a('Create Vuelos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div id="rejilla">
       <?= $this->render('_parcial', [
       'dataProvider' => $dataProvider,
       ]) ?>
    </div>

</div>
