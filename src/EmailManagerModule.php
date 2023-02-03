<?php

namespace eseperio\emailManager;

use yii\base\Module;

class EmailManagerModule extends Module
{
    public $defaultRoute = 'account/index';

    /**
     * @var string The name of the component that will be used to send emails
     */
    public $mailer = "mailer";
    /**
     * @var bool Whether to show the IMAP settings in the email account form
     */
    public $showImapSettings = true;

    /**
     * @var array The configuration of the transport that will be used to send emails
     * Keep in mind the transport will be created using the Yii::createObject method and
     * the email account parameters will be overwritten by the ones stored in the database
     */
    public $transport = [
        'class' => 'Swift_SmtpTransport',
        'timeout' => 5 // Timeout has been reduced. A good server should respond in less than 1 second
    ];

    public function init()
    {
        $this->initTranslations();
        parent::init();
    }

    public function initTranslations()
    {

        $i18n = \Yii::$app->i18n;
        if (!$i18n) {
            return;
        }
        $i18n->translations['email-manager'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@eseperio/emailManager/messages',
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                'email-manager' => 'email-manager.php',
            ],
        ];
    }


}
