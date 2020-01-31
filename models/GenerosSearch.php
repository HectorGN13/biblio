<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Generos;

/**
 * GenerosSearch represents the model behind the search form of `app\models\Generos`.
 */
class GenerosSearch extends Generos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'total'], 'integer'],
            [['denom', 'created_at'], 'safe'],
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
        $query = Generos::findWithTotal();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['total'] = [
            'asc' => ['COUNT(l.id)' => SORT_ASC],
            'desc' => ['COUNT(l.id)' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'denom', $this->denom]);
        $query->andFilterHaving(['COUNT(l.id)' => $this->total]);

        return $dataProvider;
    }
}
