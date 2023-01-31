# yii2-email-accounts-manager

Use and manage different email accounts under the same project.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

`composer reqruire eseperio/yii2-email-accounts-manager`

Add the migration path to your console config:

```php
return [
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                'eseperio\emailmanager\migrations',
            ],
        ],
    ],
];
```

Add the module to your app modules configuration

```php
return [
    'modules' => [
        'email-manager' => \eseperio\emailManager\EmailManagerModule::class,
        'showImapSettings' => false, // change if you need imap settings to be shown,
        // 'mailer'=> 'mailer',
        // 'transport => ['class' => 'Swift_SmtpTransport'],
    ]
]
```

## Usage

    Important: This module will replace the current transport for the mailer defined and it does not restore to previous value. 
    If you want to prevent this use a different mailer component for this module.

This module includes methods for checking whether the email account is valid and for sending emails using the given
configuration.


