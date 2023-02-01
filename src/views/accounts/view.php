<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eseperio\emailManager\models\EmailAccount */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('email-manager', 'Email Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="email-account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('email-manager', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('email-manager', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('email-manager', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'address',
            'user',
            'password',
            'host',
            'port',
            'encryption',
            'validate_cert',
            'sent_folder',
            'inbox_folder',
            'draft_folder',
            'trash_folder',
        ],
    ]) ?>

</div>
