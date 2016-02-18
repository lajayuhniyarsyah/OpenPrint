<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeliveryNote;

/**
 * DeliveryNoteSearch represents the model behind the search form about `app\models\DeliveryNote`.
 */
class DeliveryNoteSearch extends DeliveryNote
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'partner_shipping_id', 'prepare_id', 'work_order_id', 'work_order_in'], 'integer'],
            [['create_date', 'write_date', 'colorcode', 'poc', 'name', 'note', 'state', 'tanggal', 'ekspedisi', 'jumlah_coli', 'terms', 'partner_id', /*'partner.display_name'*/], 'safe'],
            [['special'], 'boolean'],
        ];
    }

    /*public function attributes()
    {
        return array_merge(parent::attributes(),['partner.display_name']);
    }*/

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
        $query = DeliveryNote::find();
        $query->joinWith(['partner']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'create_uid' => $this->create_uid,
            'create_date' => $this->create_date,
            'write_date' => $this->write_date,
            'write_uid' => $this->write_uid,
            'partner_shipping_id' => $this->partner_shipping_id,
            'tanggal' => $this->tanggal,
            'prepare_id' => $this->prepare_id,
            'special' => $this->special,
            'work_order_id' => $this->work_order_id,
            'work_order_in' => $this->work_order_in,
        ]);

        $query->andFilterWhere(['like', 'colorcode', $this->colorcode])
            ->andFilterWhere(['like', 'poc', $this->poc])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'ekspedisi', $this->ekspedisi])
            ->andFilterWhere(['like', 'jumlah_coli', $this->jumlah_coli])
            ->andFilterWhere(['like', 'terms', $this->terms])
            ->andFilterWhere(['ilike', 'res_partner.display_name', $this->partner_id]);

        return $dataProvider;
    }
}
