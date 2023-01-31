<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eseperio\emailManager\models\EmailAccount */

$this->title = Yii::t('app', 'Create Email Account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
