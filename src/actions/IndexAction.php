<?php

namespace eseperio\emailManager\actions;

use eseperio\emailManager\models\EmailAccountSearch;
use Yii;
use yii\base\Action;

/**
 *
 */
class IndexAction extends Action
{
    /**
     * @var string
     */
    public $searchModelClass = EmailAccountSearch::class;

    /**
     * @var EmailAccountSearch
     */
    private $_searchModel;

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        return $this->controller->render('index', [
            'dataProvider' => $this->getDataProvider(),
            'searchModel' => $this->getSearchModel()
        ]);
    }

    /**
     * @return EmailAccountSearch
     * @throws \yii\base\InvalidConfigException
     */
    protected function getSearchModel()
    {
        if ($this->_searchModel === null) {
            $this->_searchModel = Yii::createObject($this->searchModelClass);
        }
        return $this->_searchModel;
    }

    /**
     * @return \yii\data\ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     */
    private function getDataProvider()
    {
        return $this->getSearchModel()->search(Yii::$app->request->queryParams);
    }
}
