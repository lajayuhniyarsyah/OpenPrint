<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use app\models\DeliveryNote;
use yii\db\Query;
use yii\db\ActiveQuery;
use yii\db\ActiveQueryInterface;
use yii\db\Connection;
use yii\db\QueryInterface;

/**
 * DeliveryNoteSearch represents the model behind the search form about `app\models\DeliveryNote`.
 */
class DeliveryNoteSearch extends DeliveryNote
{
    public $year_tanggal, $month_tanggal, $year_po, $month_po, $query;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'partner_shipping_id', 'prepare_id', 'work_order_id', 'work_order_in'], 'integer'],
            [['create_date', 'write_date', 'colorcode', 'poc', 'name', 'note', 'state', 'tanggal', 'ekspedisi', 'jumlah_coli', 'terms', 'partner_id', 'saleOrder.date_order'], 'safe'],
            [['special'], 'boolean',],
            [['year_tanggal', 'year_po'],'integer','max'=>date("Y"),'min'=>2014],
            [['month_tanggal', 'month_po'], 'integer'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(),['saleOrder.date_order']);
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
    public function searchKPI($params,$pageSize=20)
    {
        $query = DeliveryNote::find()
            ->where(['delivery_note.state' => 'done']);

        /*$dataProvider->sort->attributes['saleOrder.date_order'] = [
            'asc' => ['saleOrder.date_order' => SORT_ASC],
            'desc' => ['saleOrder.date_order' => SORT_DESC],
        ];*/

        $query->joinWith(['partner','saleOrder']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->year_tanggal != null) {
            $query->andWhere(['and','EXTRACT(YEAR FROM delivery_note.tanggal) = '.$this->year_tanggal]);
        }
        if($this->month_tanggal != null) {
            $query->andWhere(['and','EXTRACT(MONTH FROM delivery_note.tanggal) = '.$this->month_tanggal]);
        }
        /*if($this->year_tanggal && $this->month_tanggal != null) {
            $query->andWhere(['and','EXTRACT(YEAR FROM delivery_note.tanggal) = '.$this->year_tanggal]);
            $query->andWhere(['and','EXTRACT(MONTH FROM delivery_note.tanggal) = '.$this->month_tanggal]);
        }*/
        if($this->year_po != null) {
            $query->andWhere(['and','EXTRACT(YEAR FROM sale_order.date_order) = '.$this->year_po]);
        }
        if($this->month_po != null) {
            $query->andWhere(['and','EXTRACT(MONTH FROM sale_order.date_order) = '.$this->month_po]);
        }
        /*if($this->year_po && $this->month_po != null) {
            $query->andWhere(['and','EXTRACT(YEAR FROM sale_order.date_order) = '.$this->year_po]);
            $query->andWhere(['and','EXTRACT(MONTH FROM sale_order.date_order) = '.$this->month_po]);
        }*/

        if($this->partner_id != null) {
            $query->andFilterWhere([
                'ilike', 'res_partner.display_name', $this->partner_id,
            ]);
        }

        return $dataProvider;
    }

    /*public function reportKPI($params)
    {
        // $query = new Query;
        $query = <<<query
SELECT
    delivery_note.name AS "Delivery Note",
    stock_picking.date_done AS "DN/SJ Date",
    res_partner.display_name AS "Address Name",
    sale_order.date_order AS "Tgl PO/Barang Masuk",
    delivery_note.tanggal AS "Tanggal Kirim"
FROM 
    delivery_note
LEFT JOIN
    res_partner ON delivery_note.partner_id = res_partner.id
LEFT JOIN 
    stock_picking ON res_partner.id = stock_picking.partner_id
LEFT JOIN 
    order_preparation ON delivery_note.prepare_id = order_preparation.id
LEFT JOIN 
    sale_order ON order_preparation.sale_id = sale_order.id 
WHERE 
    delivery_note.state='done' 
    AND EXTRACT(YEAR FROM delivery_note.tanggal) = 2015
    AND EXTRACT(MONTH FROM delivery_note.tanggal) = 1
    AND EXTRACT(YEAR FROM sale_order.date_order) = 2015
    AND EXTRACT(MONTH FROM sale_order.date_order) = 1
    AND res_partner.display_name ILIKE '%FREEPORT INDONESIA, PT%'
query;

        $connection = Yii::$app->db;
        $res = $connection->createCommand($query)->queryAll();

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $res,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }*/

}
