<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_invoice_line_tax_amount".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $tax_amount
 * @property boolean $is_manual
 * @property integer $tax_id
 * @property double $base_amount
 * @property integer $invoice_line_id
 *
 * @property AccountInvoiceLine $invoiceLine
 * @property AccountTax $tax
 * @property ResUsers $createU
 * @property ResUsers $writeU
 */
class AccountInvoiceLineTaxAmount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_invoice_line_tax_amount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'tax_id', 'invoice_line_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['tax_amount', 'base_amount'], 'number'],
            [['is_manual'], 'boolean'],
            [['tax_id', 'invoice_line_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'tax_amount' => 'Tax Amount',
            'is_manual' => 'Is Manual Fill',
            'tax_id' => 'Tax Applied',
            'base_amount' => 'Base Line Tax Amount',
            'invoice_line_id' => 'Invoice Line',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceLine()
    {
        return $this->hasOne(AccountInvoiceLine::className(), ['id' => 'invoice_line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTax()
    {
        return $this->hasOne(AccountTax::className(), ['id' => 'tax_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWriteU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'write_uid']);
    }
}
