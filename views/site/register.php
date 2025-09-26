<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use Symfony\Component\VarDumper\VarDumper;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
// Yii::debug($model->attributes);
// VarDumper::dump($model, 10, true); die;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>



    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

            <!-- * @property string $fullName
            * @property string $login
            * @property string $password
            * @property string $email
            * @property string $phone -->

            <?= $form->field($model, 'fullName')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'login', ['enableAjaxValidation' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => '8(999)999-99-99'
            ]) ?>


            <div class="form-group">
                <div class='d-flex justify-content-between align-items-baseline'>
                    <?= Html::a("Авторизация!", "login", ['class' => "p-0"]) ?>
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>