<?php

namespace eseperio\emailManager\models;

/**
 * This is the ActiveQuery class for [[EmailAccount]].
 *
 * @see EmailAccount
 */
class EmailAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EmailAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EmailAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
