<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SbmWorkOrder;

/**
 * SbmWorkOrderSearch represents the model behind the search form about `app\models\SbmWorkOrder`.
 */
class SbmWorkOrderSearch extends SbmWorkOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'adhoc_order_request_id', 'approver', 'sale_order_id', 'repeat_ref_id', 'location_id', 'customer_site_id', 'approver2', 'approver3', 'customer_id'], 'integer'],
            [['create_date', 'write_date', 'due_date', 'state', 'order_date', 'work_location', 'source_type', 'wo_no', 'request_no', 'notes', 'seq_wo_no', 'seq_req_no'], 'safe'],
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
        $query = SbmWorkOrder::find();

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
            'adhoc_order_request_id' => $this->adhoc_order_request_id,
            'due_date' => $this->due_date,
            'approver' => $this->approver,
            'sale_order_id' => $this->sale_order_id,
            'repeat_ref_id' => $this->repeat_ref_id,
            'order_date' => $this->order_date,
            'location_id' => $this->location_id,
            'customer_site_id' => $this->customer_site_id,
            'approver2' => $this->approver2,
            'approver3' => $this->approver3,
            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'work_location', $this->work_location])
            ->andFilterWhere(['like', 'source_type', $this->source_type])
            ->andFilterWhere(['like', 'wo_no', $this->wo_no])
            ->andFilterWhere(['like', 'request_no', $this->request_no])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'seq_wo_no', $this->seq_wo_no])
            ->andFilterWhere(['like', 'seq_req_no', $this->seq_req_no]);

        return $dataProvider;
    }
}
