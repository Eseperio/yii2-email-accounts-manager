<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eseperio\emailManager\models\EmailAccount */

$this->title = Yii::t('email-manager', 'Update Email Account: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('email-manager', 'Email Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('email-manager', 'Update');
?>
<div class="email-account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
