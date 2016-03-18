<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class ReportYearSummaryProductSalesByCategoryForm extends Model
{
    public $category;
    public $year;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            [['year'], 'required'], /// year harus diisi
            [['year'],'number','integerOnly'=>true],
            [['category'],'string'],
        ];
    }
}
