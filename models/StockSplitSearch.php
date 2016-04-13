<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StockSplit;

/**
 * StockSplitSearch represents the model behind the search form about `app\models\StockSplit`.
 */
class StockSplitSearch extends StockSplit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'location', 'picking_id'], 'integer'],
            [['create_date', 'write_date', 'date_done', 'no', 'notes', 'state', 'date_order', 'stock_split_no'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = StockSplit::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'create_uid' => $this->create_uid,
            'create_date' => $this->create_date,
            'write_date' => $this->write_date,
            'write_uid' => $this->write_uid,
            'date_done' => $this->date_done,
            'location' => $this->location,
            'date_order' => $this->date_order,
            'picking_id' => $this->picking_id,
        ]);

        $query->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'stock_split_no', $this->stock_split_no]);

        return $dataProvider;
    }
}
