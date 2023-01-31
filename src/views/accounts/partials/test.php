<?php


/* @var $this \yii\web\View */
/* @var $showImap bool */
/* @var $model \eseperio\emailManager\models\EmailAccount */

// get the form name for a given model
$formName = $model->formName();


?>


<div>
    <div class="alert alert-success imap-success collapse">
        <div><?= Yii::t('email-manager', 'IMAP configuration seems ok') ?></div>
        <div><strong><?= Yii::t('email-manager','Important') ?>: </strong><?= Yii::t('email-manager', 'Folders configuration has been set to automatically detected within the account, but changes has not been stored.') ?></div>
    </div>
    <div class="alert alert-success collapse" id="test-success">
        <span><?= Yii::t('email-manager', 'Configuration seems ok') ?></span>
    </div>
    <div class="test-error-message collapse">
        <div class="alert alert-danger"><?= Yii::t('email-manager', 'Wrong configuration') ?></div>
        <pre id="test-error">

    </pre>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="btn btn-default btn-block test-smtp"><?= Yii::t('email-manager', 'Test SMTP') ?></div>
    </div>

    <?php if ($showImap): ?>
        <div class="col-md-6">
            <div class="btn btn-default btn-block test-imap">
                <?= Yii::t('email-manager', 'Test IMAP') ?></div>
        </div>
    <?php endif; ?>

</div>


