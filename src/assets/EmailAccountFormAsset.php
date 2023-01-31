<?php

namespace eseperio\emailManager\assets;

use eseperio\admintheme\helpers\Html;
use eseperio\emailManager\models\EmailAccount;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\web\AssetBundle;

class EmailAccountFormAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . "/dist";

    public $js = [
        'js/email-account.js'
    ];

    public function registerAssetFiles($view)
    {
        $model = new EmailAccount();

        $settings = Json::encode([
            'emailFormSelector' => '#email-account-form',
            'imapSentFolderInputId' => Html::getInputId(($model), 'imap_sent_folder'),
            'imapInboxFolderInputId' => Html::getInputId($model, 'imap_inbox_folder'),
            'urls' => [
                'imap' => \yii\helpers\Url::to(['accounts/test-imap']),
                'smtp' => \yii\helpers\Url::to(['accounts/test-smtp']),
            ]
        ]);
        $view->registerJs(<<<JS
if(typeof emailConfigInstance == "undefined"){
    emailConfigInstance = emailConfig.init($settings)
}
JS
        );
        parent::registerAssetFiles($view);
    }
}
