# yii2-email-accounts-manager

Use and manage different email accounts under the same project.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

`composer require eseperio/yii2-email-accounts-manager`

Add the migration path to your console config:

```php
return [
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@vendor/eseperio/yii2-email-accounts-manager/src/migrations',
            ],
        ],
    ],
];
```

Add the module to your app modules configuration

```php
return [
    'modules' => [
        'email-manager' =>[
        'class'=> \eseperio\emailManager\EmailManagerModule::class,      
        'showImapSettings' => false, // change if you need imap settings to be shown,
        // 'mailer'=> 'mailer',
        // 'transport => ['class' => 'Swift_SmtpTransport'],
        ],
       
    ]
]
```

## Usage

    Important: This module will replace the current transport for the mailer defined and it does not restore to previous value. 
    If you want to prevent this use a different mailer component for this module.

This module includes methods for checking whether the email account is valid and for sending emails using the given
configuration.

The EmailAccount model includes useful methods, like `getTransport()` and `setAsMainTransport()`.

`getTransport()` returns the transport configuration based on configuration defined within module and the account itself.


`setAsMainTransport()` will set the transport configuration for the mailer component defined in the module configuration and will return the mailer instance.
`compose($view='',$params=[])` will return a new message instance preconfigured with the transport configuration for the account and also `setFrom` defined with the account address.

### Sending an email from a custom account

```php
use eseperio\emailmanager\models\EmailAccount;

$account = EmailAccount::findOne(1)->compose('test', ['message' => 'Hello world!'])->setTo('someaddress@example.com')->send();
```


