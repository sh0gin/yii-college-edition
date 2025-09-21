<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Application $model */

$this->title = 'Заявка ' . $model->id . " от " . Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y H:m:s');
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p class="d-flex gap-3">
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        <?= !(bool)$model?->feedback 
        ?  Html::a('Отзыв', ['feedback', 'id' => $model->id], ['class' => 'btn btn-outline-warning'])
        : "" 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'created_at',
                'value' => Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y H:m:s'),
            ],
            [
                'attribute' => 'data_start',
                'value' => Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y'),
            ],
            [
                'attribute' => 'course_id',
                'value' => $model->course->name,
            ],
            [
                'attribute' => 'pay_type_id',
                'value' => $model->payType->title,
            ],
            [
                'attribute' => 'status_id',
                'value' => $model->status->title,
            ],
            [
                'label' => "Отзыва",
                'visible' => (bool)$model?->feedback,
                'format' => 'html',
                'value' => $model->feedback ? nl2br($model->feedback->comment) : "",
            ]
        ],
    ]) ?>

</div>
