<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SbmAdhocOrderRequest;

/**
 * SbmAdhocOrderRequestSearch represents the model behind the search form about `app\models\SbmAdhocOrderRequest`.
 */
class SbmAdhocOrderRequestSearch extends SbmAdhocOrderRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'term_of_payment', 'attention_id', 'sales_man_id', 'customer_site_id', 'sale_group_id', 'customer_id'], 'integer'],
            [['create_date', 'write_date', 'cust_ref_no', 'scope_of_work', 'term_condition', 'name', 'cust_ref_type', 'state', 'notes'], 'safe'],
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
        $query = SbmAdhocOrderRequest::find();

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
            'term_of_payment' => $this->term_of_payment,
            'attention_id' => $this->attention_id,
            'sales_man_id' => $this->sales_man_id,
            'customer_site_id' => $this->customer_site_id,
            'sale_group_id' => $this->sale_group_id,
            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['like', 'cust_ref_no', $this->cust_ref_no])
            ->andFilterWhere(['like', 'scope_of_work', $this->scope_of_work])
            ->andFilterWhere(['like', 'term_condition', $this->term_condition])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'cust_ref_type', $this->cust_ref_type])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
