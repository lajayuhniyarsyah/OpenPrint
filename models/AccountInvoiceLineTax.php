<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_invoice_line_tax".
 *
 * @property integer $invoice_line_id
 * @property integer $tax_id
 *
 * @property AccountInvoiceLine $invoiceLine
 * @property AccountTax $tax
 */
class AccountInvoiceLineTax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_invoice_line_tax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_line_id', 'tax_id'], 'required'],
            [['invoice_line_id', 'tax_id'], 'integer'],
            [['invoice_line_id', 'tax_id'], 'unique', 'targetAttribute' => ['invoice_line_id', 'tax_id'], 'message' => 'The combination of Invoice Line ID and Tax ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invoice_line_id' => 'Invoice Line ID',
            'tax_id' => 'Tax ID',
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
}
