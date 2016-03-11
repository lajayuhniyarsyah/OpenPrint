<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ReportBalanceOfItemStock extends Model
{
	public $product_id;
	public $warelct;

	public function rules()
	{
		 return [
            
            [['product_id'], 'required'], /// year harus diisi
            [['product_id'],'string'],
            [['warelct'],'required'],
            [['warelct'],'string'],
        ];
	}
}
?>