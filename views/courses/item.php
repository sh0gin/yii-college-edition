<?php

use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

?>
<div class="card mb-3 w-50">
    <div class="card-header text fw-bold fs-5">
        <?= $model->name ?>
    </div>
    <div class="card-body">
        <?= VarDumper::dump($model->image, 10, true) ?>
    </div>
    <div class='d-flex gap-3 m-3 justify-content-end'>

    </div>
</div>