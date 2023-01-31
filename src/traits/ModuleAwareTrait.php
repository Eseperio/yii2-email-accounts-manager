<?php

namespace eseperio\emailManager\traits;


use eseperio\proshop\common\core\CoreModule;
use Yii;

/**
 * @property-read CoreModule $module
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
