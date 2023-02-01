<?php

namespace eseperio\emailManager\traits;


use Yii;

/**
 * @property-read \yii\base\Module $module
 */
trait ModuleAwareTrait
{
    /**
     * @param null $app
     * @return \eseperio\emailManager\EmailManagerModule
     */
    public static function getModule($app = null)
    {
        if (!$app) {
            $app = Yii::$app;
        }
        return $app->getModule('email-manager');
    }
}
