<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Application $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-form">
    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-outline-primary']) ?> 
    </p>
    <?php $form = ActiveForm::begin(); ?>
    <div class='w-25'>
        <?= $form->field($model, 'comment')->textarea() ?>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div> 