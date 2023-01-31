<?php


/* @var $this \yii\web\View */
/* @var $showImap bool */
/* @var $model \eseperio\emailManager\models\EmailAccount */

// get the form name for a given model
$formName = $model->formName();

$this->registerJs(<<<JS
$('.test-imap').on('click', function () {
    var form = $('[name="$formName"]');
    var url = form.attr('action');
    var data = form.serialize();
    $.post(url, data, function (response) {
        if (response.success) {
            alert('Success');
        } else {
            alert('Error');
        }
    });
});
JS
)

?>


<div class="row">
    <div class="col-md-6">
        <div class="btn btn-default btn-block"><?= Yii::t('email-manager', 'Test SMTP') ?></div>
    </div>

    <?php if ($showImap): ?>
        <div class="col-md-6">
            <div class="btn btn-default btn-block test-imap">
                <?= Yii::t('email-manager', 'Test IMAP') ?></div>
        </div>
    <?php endif; ?>

</div>


