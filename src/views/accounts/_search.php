<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eseperio\emailManager\models\EmailAccountSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-account-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'user') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'host') ?>

    <?php // echo $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'encryption') ?>

    <?php // echo $form->field($model, 'validate_cert') ?>

    <?php // echo $form->field($model, 'sent_folder') ?>

    <?php // echo $form->field($model, 'inbox_folder') ?>

    <?php // echo $form->field($model, 'draft_folder') ?>

    <?php // echo $form->field($model, 'trash_folder') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
