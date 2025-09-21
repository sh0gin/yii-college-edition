<?php

use yii\bootstrap5\Html;
?>
<div class="card mb-3">
    <div class="card-header text fw-bold fs-5">
        <?= 'Заявка ' . $model->id . " от " . Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y H:m:s'); ?>
    </div>
    <div class="card-body">
        <div>
            <span class="fw-bold"> Дата начала обучения: </span> <?= Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y') ?>
        </div>
        <div>
            <span class="fw-bold"> Клиент: </span> <?= $model->user->fullName ?>
        </div>
        <div>
            <span class="fw-bold"> Наименование курса: </span> <?= $model->course->name ?>
        </div>
        <div>
            <span class="fw-bold"> Способ оплаты: </span> <?= $model->payType->title ?>
        </div>
        <div>
            <span class="fw-bold"> Статус заявки: </span> <?= $model->status->title ?>
        </div>
    </div>
    <div class='d-flex gap-3 m-3 justify-content-end'>
        <?= $model->status->alias !== 'start' && $model->status->alias !== 'end'
            ? Html::a('Идёт обучение', ['todo', 'id' => $model->id], ['class' => 'btn btn-outline-warning', 'data-method' => "post"])
            . Html::a('Идёт обучение 2', ['change-status', 'id' => $model->id, 'status' => 'start'], ['class' => 'btn btn-outline-info', 'data-method' => "post"])
            : ""
        ?>
        <?= $model->status->alias !== 'end'
            ? Html::a('Обучение завершенно', ['end', 'id' => $model->id], ['class' => 'btn btn-outline-info', 'data-method' => "post"])
            . Html::a('Обучение завершенно 2', ['change-status', 'id' => $model->id, 'status' => 'end'], ['class' => 'btn btn-outline-info', 'data-method' => "post"])
            : ""
        ?>
        <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary']); ?>
    </div>
</div>