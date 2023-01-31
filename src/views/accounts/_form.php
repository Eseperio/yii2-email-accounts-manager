<?php

use eseperio\proshop\common\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eseperio\emailManager\models\EmailAccount */
/* @var $form yii\widgets\ActiveForm */

\eseperio\emailManager\assets\EmailAccountFormAsset::register($this);
$showImapSettings = ArrayHelper::getValue($this->params, 'module.showImapSettings')
?>

<div class="email-account-form">

    <?php $form = ActiveForm::begin([
            'id' => 'email-account-form'
    ]); ?>

    <div class="row">
        <div class="col-md-6 col-lg-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('email-manager', 'Account') ?></h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'user')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>
                </div>
            </div>


        </div>
        <div class="col-md-6 col-lg-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('email-manager', 'SMTP configuration') ?></h3>
                </div>
                <div class="panel-body">

                    <?= $form->field($model, 'outgoing_server')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'smtp_port')->textInput() ?>

                    <?= $form->field($model, 'smtp_encryption')->dropDownList([
                        'ssl' => 'ssl',
                        'tls' => 'tls',
                        null => Yii::t('email-manager', 'None')
                    ]) ?>

                    <div class="checkbox">
                        <?= $form->field($model, 'smtp_validate_cert')->checkbox() ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <?php
    if ($showImapSettings): ?>
        <div class="col-md-6 col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('email-manager', 'IMAP configuration') ?></h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'incoming_server')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'imap_port')->textInput() ?>

                    <?= $form->field($model, 'imap_encryption')->dropDownList([
                        'ssl' => 'ssl',
                        'tls' => 'tls',
                        null => Yii::t('email-manager', 'None')
                    ]) ?>

                    <div class="checkbox">
                        <?= $form->field($model, 'smtp_validate_cert')->checkbox() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('email-manager', 'Folders') ?></h3>
                </div>
                <div class="panel-body">

                    <?= $form->field($model, 'sent_folder')->dropDownList(['maxlength' => 255]) ?>
                    <?= $form->field($model, 'inbox_folder')->textInput(['maxlength' => 255]) ?>
                    <?= $form->field($model, 'draft_folder')->textInput(['maxlength' => 255]) ?>
                    <?= $form->field($model, 'trash_folder')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-body">
                <?= Yii::t('email-manager', 'Before saving changes, it is highly recomended testing each protocol you are going to use') ?>
                <hr>
                <?= $this->render('partials/test', [
                    'showImap' => $showImapSettings,
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('email-manager', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
