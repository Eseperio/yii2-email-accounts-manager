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

            'addressInputId' => Html::getInputId($model, 'address'),
            'userInputId' => Html::getInputId($model, 'user'),
            'passwordInputId' => Html::getInputId($model, 'password'),
            'outgoingServerInputId' => Html::getInputId($model, 'outgoing_server'),
            'incomingServerInputId' => Html::getInputId($model, 'incoming_server'),
            'smtpPortInputId' => Html::getInputId($model, 'smtp_port'),
            'smtpEncryptionInputId' => Html::getInputId($model, 'smtp_encryption'),
            'imapHostInputId' => Html::getInputId($model, 'imap_host'),
            'imapPortInputId' => Html::getInputId($model, 'imap_port'),
            'imapEncryptionInputId' => Html::getInputId($model, 'imap_encryption'),
            
            'imapSentFolderInputId' => Html::getInputId($model, 'sent_folder'),
            'imapInboxFolderInputId' => Html::getInputId($model, 'inbox_folder'),
            'imapTrashFolderInputId' => Html::getInputId($model, 'trash_folder'),
            'imapDraftsFolderInputId' => Html::getInputId($model, 'draft_folder'),
            'urls' => [
                'imap' => \yii\helpers\Url::to(['account/test-imap']),
                'smtp' => \yii\helpers\Url::to(['account/test-smtp']),
                'autodiscover' => \yii\helpers\Url::to(['account/autodiscover']),
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
