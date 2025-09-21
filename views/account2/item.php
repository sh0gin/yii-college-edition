<?php

use yii\bootstrap5\Html;
?>
<div class="card mb-3">
  <div class="card-header text fw-bold fs-5">
    <?= 'Заявка ' . $model->id . " от " . Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y H:m:s'); ?>
  </div>
  <div class="card-body">
      <div>
          <span class="fw-bold"> Дата начала обучения: </span> <?=  Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y') ?>
      </div>
      <div>
          <span class="fw-bold"> Наименование курса: </span> <?=  $model->course->name ?>
      </div>
      <div>
          <span class="fw-bold"> Способ оплаты: </span> <?= $model->payType->title ?>
      </div>
      <div>
          <span class="fw-bold"> Статус заявки: </span> <?=  $model->status->title ?>
      </div>      
  </div>
  <div class='d-flex gap-3 m-3 justify-content-end'>
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary']); ?>
    <?= $model->status->alias === 'end' && !$model?->feedback
        ? Html::a('Отзыв', ['feedback', 'id' => $model->id], ['class' => 'btn btn-outline-warning'])
        : ""
        ?>
  </div>
</div>
