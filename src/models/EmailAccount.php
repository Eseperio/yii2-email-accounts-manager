<?php

namespace eseperio\emailManager\models;

use eseperio\emailManager\traits\ModuleAwareTrait;
use Yii;

/**
 * This is the model class for table "{{%email_account}}".
 *
 * @property int $id
 * @property string $address
 * @property string $user
 * @property string $password
 * @property string $outgoing_server Outgoing server
 * @property string $incoming_server Incoming server
 * @property int $imap_port IMAP port
 * @property int $smtp_port SMTP port
 * @property string $smtp_encryption
 * @property string $imap_encryption
 * @property int $smtp_validate_cert
 * @property int $imap_validate_cert
 * @property string|null $sent_folder Sent folder
 * @property string|null $inbox_folder Inbox folder
 * @property string|null $draft_folder Draft folder
 * @property string|null $trash_folder Trash folder
 */
class EmailAccount extends \yii\db\ActiveRecord
{
    use ModuleAwareTrait;

    public function init()
    {
        if (empty($this->smtp_validate_cert)) {
            $this->smtp_validate_cert = 1;
        }
        if (empty($this->imap_validate_cert)) {
            $this->imap_validate_cert = 1;
        }
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_account}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['address', 'user', 'password', 'outgoing_server'], 'required'],
            ['incoming_server', 'required', 'enableClientValidation' => false, 'when' => function ($model) {
                return self::getModule()->showImapSettings;
            }],
            ['incoming_server', 'default', 'value' => 'outgoing_server'],
            [['imap_port', 'smtp_port', 'smtp_validate_cert', 'imap_validate_cert'], 'integer'],
            [['address', 'user', 'password', 'outgoing_server', 'incoming_server', 'smtp_encryption', 'imap_encryption', 'sent_folder', 'inbox_folder', 'draft_folder', 'trash_folder'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('email-manager', 'ID'),
            'address' => Yii::t('email-manager', 'Address'),
            'user' => Yii::t('email-manager', 'User'),
            'password' => Yii::t('email-manager', 'Password'),
            'outgoing_server' => Yii::t('email-manager', 'Outgoing server'),
            'incoming_server' => Yii::t('email-manager', 'Incoming server'),
            'imap_port' => Yii::t('email-manager', 'IMAP port'),
            'smtp_port' => Yii::t('email-manager', 'SMTP port'),
            'smtp_encryption' => Yii::t('email-manager', 'Smtp Encryption'),
            'imap_encryption' => Yii::t('email-manager', 'Imap Encryption'),
            'smtp_validate_cert' => Yii::t('email-manager', 'Smtp Validate Cert'),
            'imap_validate_cert' => Yii::t('email-manager', 'Imap Validate Cert'),
            'sent_folder' => Yii::t('email-manager', 'Sent folder'),
            'inbox_folder' => Yii::t('email-manager', 'Inbox folder'),
            'draft_folder' => Yii::t('email-manager', 'Draft folder'),
            'trash_folder' => Yii::t('email-manager', 'Trash folder'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return EmailAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmailAccountQuery(get_called_class());
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getSmtpTransport()
    {
        $defaultConfig = [
            'host' => $this->outgoing_server,
            'port' => $this->smtp_port,
            'encryption' => $this->smtp_encryption,
            'username' => $this->user,
            'password' => $this->password,

        ];

        if (!$this->smtp_validate_cert) {
            $defaultConfig['streamOptions'] = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
        }
        return array_merge_recursive(self::getModule()->transport, $defaultConfig);
    }

    /**
     * @return object|null
     * @throws \yii\base\InvalidConfigException
     */
    public function setAsMainTransport()
    {
        $mailer = Yii::$app->get(self::getModule()->mailer);
        $mailer->setTransport($this->getSmtpTransport());
        return $mailer;
    }


    /**
     * Shortcut to compose an email directly from this account
     * @param null $view
     * @param array $params
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function compose($view = null, $params = [])
    {
        /* @var $mailer \yii\mail\MailerInterface */
        $mailer = $this->setAsMainTransport();
        return $mailer->compose($view, $params)->setFrom($this->address)->setReplyTo($this->address);
    }

}
