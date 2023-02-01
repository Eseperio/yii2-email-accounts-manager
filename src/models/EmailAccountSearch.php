<?php

namespace eseperio\emailManager\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EmailAccountSearch represents the model behind the search form of `eseperio\emailManager\models\EmailAccount`.
 */
class EmailAccountSearch extends EmailAccount
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'user', 'password', 'host', 'encryption', 'sent_folder', 'inbox_folder', 'draft_folder', 'trash_folder'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EmailAccount::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'sent_folder', $this->sent_folder])
            ->andFilterWhere(['like', 'inbox_folder', $this->inbox_folder])
            ->andFilterWhere(['like', 'draft_folder', $this->draft_folder])
            ->andFilterWhere(['like', 'trash_folder', $this->trash_folder]);

        return $dataProvider;
    }
}
