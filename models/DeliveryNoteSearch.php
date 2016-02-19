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
    public $status, $year_tanggal, $month_tanggal, $year_po, $month_po;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'partner_shipping_id', 'prepare_id', 'work_order_id', 'work_order_in'], 'integer'],
            [['create_date', 'write_date', 'colorcode', 'poc', 'name', 'note', 'state', 'tanggal', 'ekspedisi', 'jumlah_coli', 'terms', 'partner_id', /*'partner.display_name'*/], 'safe'],
            [['special'], 'boolean',],
            [['year_tanggal'],'integer','max'=>date("Y"),'min'=>2014],
            [[ 'month_tanggal', 'year_po', 'month_po'], 'integer'],
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
            'partner_id' => $this->partner_id,
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
            ->andFilterWhere(['like', 'terms', $this->terms]);

        return $dataProvider;
    }

    // search untuk report KPI
    public function searchKPI($params)
    {
        $query = DeliveryNote::find()
            ->where(['state' => 'done']);

        $query->joinWith(['partner']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->year_tanggal /*&& $this->year_po*/ != null) {
            $query->andWhere(['and','EXTRACT(YEAR FROM "tanggal") = '.$this->year_tanggal]);
            // $query->andWhere(['and','EXTRACT(YEAR FROM "date_order") = '.$this->year_po]);
        }
        if($this->month_tanggal /*&& $this->month_po*/ != null) {
            $query->andWhere(['and','EXTRACT(MONTH FROM "tanggal") = '.$this->month_tanggal]);
            // $query->andWhere(['and','EXTRACT(YEAR FROM "date_order") = '.$this->month_po]);
        }
        if($this->year_tanggal && $this->month_tanggal/* && $this->year_po && $this->month_po*/ != null) {
            $query->andWhere(['and','EXTRACT(YEAR FROM "tanggal") = '.$this->year_tanggal]);
            $query->andWhere(['and','EXTRACT(MONTH FROM "tanggal") = '.$this->month_tanggal]);
            // $query->andWhere(['and','EXTRACT(YEAR FROM "date_order") = '.$this->year_po]);
            // $query->andWhere(['and','EXTRACT(YEAR FROM "date_order") = '.$this->month_po]);
        }

        $query->andFilterWhere(['ilike', 'res_partner.display_name', $this->partner_id]);

        return $dataProvider;
    }
}
