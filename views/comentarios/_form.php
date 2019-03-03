<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentarios-form">

    <?php
    if (isset($action)) {
        $form = ActiveForm::begin(['action' => $action]);
    } else {
        $form = ActiveForm::begin();
    }
    ?>

    <?= $form->field($model, 'cuerpo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'padre_id')->hiddenInput(['value' => $model->padre_id])->label(false) ?>

    <?= $form->field($model, 'noticia_id')->hiddenInput(['value' => $model->noticia_id])->label(false) ?>

    <?= $form->field($model, 'usuario_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false)  ?>

    <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
