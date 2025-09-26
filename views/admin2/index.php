<?php

use app\models\Application;
use app\models\Courses;
use app\models\PayType;
use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Панель администратора';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => LinkPager::class,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'created_at',
                'value' => fn($model) => Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y H:m:s'),
            ],
            [
                'attribute' => 'data_start',
                'value' => fn($model) => Yii::$app->formatter->asDateTime($model->created_at, 'php:d.m.Y'),
            ],
            [
                'attribute' => 'user_id',
                'value' => fn($model) =>$model->user->fullName,
            ],
            [
                'attribute' => 'course_id',
                'value' => fn($model) => $model->course->name,
                'filter' => Courses::getCourses(),

            ],
            [
                'attribute' => 'pay_type_id',
                'value' => PayType::getPayType(),
            ],
            [
                'attribute' => 'status_id',
                'value' => fn($model) => $model->status->title,
            ],
            [
                'label' => 'Действие',
                'format' => "html",
                'value' => function($model) {
                    $btn_view = Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary']);
                    $btn_feedback = "";
                    if ($model->status->alias === 'end' && !$model?->feedback) {
                        $btn_feedback = Html::a('Отзыв', ['feedback', 'id' => $model->id], ['class' => 'btn btn-outline-warning']);
                    }

                    return `<div class='d-flex gap-3'>` 
                    . $btn_view
                    . $btn_feedback
                    . `</div>`;
                } 
            ]
           
        ],
    ]); ?>

<?php Pjax::end() ?>
</div>
