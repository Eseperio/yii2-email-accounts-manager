<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel eseperio\emailManager\models\EmailAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('email-manager', 'Email Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-account-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('email-manager', 'Create Email Account'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'address',
//            'user',
//            'password',
            'incoming_server',
            'outgoing_server',
            //'port',
            //'encryption',
            //'validate_cert',
            //'sent_folder',
            //'inbox_folder',
            //'draft_folder',
            //'trash_folder',

            [
                'class' => \yii\grid\ActionColumn::class
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
