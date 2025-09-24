<?php

use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

?>
<div class="card mb-3 w-25">
    <div class="card-header text fw-bold fs-5">
        <?= $model->name ?>
    </div>
    <div class="card-body">

        <!-- <div class="carousel-item active">
                <img src="/image/cat.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/image/cat.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/image/cat.jpg" class="d-block w-100" alt="...">
            </div> -->
        <?php if ($model->imageCourses) {
        ?>
            <div id="carouselExample-<?= $model->id ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <?php foreach ($model->imageCourses as $key => $image) { ?>
                        <div class="carousel-item <?= $key === 0 ? 'active' : "" ?>">

                            <?= Html::img('/image/' . $image['image'] . '.' . $image['extension'], ['class' => "d-block w-100", 'alt' => "..."]) ?>

                        </div>

                    <?php
                    }
                    ?>
                </div>
                <?php if (count($model->imageCourses) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample-<?= $model->id ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample-<?= $model->id ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                <?php endif ?>
            </div>
        <?php
        }
        ?>

    </div>
    <div class='d-flex gap-3 m-3 justify-content-end'>

    </div>
</div>