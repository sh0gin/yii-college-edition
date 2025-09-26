<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Application $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-order',

    ]); ?>
    <div class='w-25'>
        <?= $form->field($model, 'data_start',  ['enableAjaxValidation' => true])->widget(\yii\widgets\MaskedInput::class, [
                'mask' => '99.99.9999',
            ])  ?>
        <?= $form->field($model, 'time_order', ['enableAjaxValidation' => true])->textInput(['type' => "time", /*'min' => '09:00', 'max' => '18:00' */]) ?>
    </div>
    
    <div class='w-50'> 
        <?= $form->field($model, 'course_id')->dropDownList($courses, ['prompt' => 'Выбирите курс']) ?>
    </div>        
    <div class='w-50'>
        <?= $form->field($model, 'pay_type_id')->dropDownList($payType, ['prompt' => 'Выбирите способ оплаты']) ?>
    </div>
        
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
        </div>
        
        <?php ActiveForm::end(); ?>

</div>
