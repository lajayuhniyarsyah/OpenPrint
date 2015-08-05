<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HrAttendanceMinMaxLog;

/**
 * HrAttendanceMinMaxLogSearch represents the model behind the search form about `app\models\HrAttendanceMinMaxLog`.
 */
class HrAttendanceMinMaxLogSearch extends HrAttendanceMinMaxLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dept_id', 'employee_id', 'scan_times_a_day', 'err_code'], 'integer'],
            [['dept_name', 'employee_name', 'full_date', 'min_log', 'hh_min_log', 'mm_min_log', 'min_state_log', 'max_log', 'hh_max_log', 'mm_max_log', 'max_state_log', 'attendance_time'], 'safe'],
            [['y_log', 'm_log', 'd_log', 'dow_log'], 'number'],
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
        // die('aass');
        $query = HrAttendanceMinMaxLog::find();
        $sort = [
            'attributes'=>[
                'employee_name'=>[
                    'default'=>SORT_ASC
                ],
                
                'y_log'=>[
                    'default'=>SORT_DESC
                ],
                'm_log'=>[
                    'default'=>SORT_ASC
                ],
                'd_log'=>[
                    'default'=>SORT_ASC
                ],
                'dept_name',
            ],
            'defaultOrder'=>[
                'employee_name'=>SORT_ASC,
                'y_log'=>SORT_DESC,
                'm_log'=>SORT_DESC,
                'd_log'=>SORT_ASC
            ]
        ];

        if($this->load($params)){
            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');

                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'dept_id' => $this->dept_id,
                'employee_id' => $this->employee_id,
                'full_date' => $this->full_date,
                'y_log' => $this->y_log,
                'm_log' => $this->m_log,
                'd_log' => $this->d_log,
                'dow_log' => $this->dow_log,
                'scan_times_a_day' => $this->scan_times_a_day,
                'err_code' => $this->err_code,
            ]);

            $query->andFilterWhere(['like', 'dept_name', strtoupper($this->dept_name)])
                ->andFilterWhere(['like', 'employee_name', strtoupper($this->employee_name)])
                ->andFilterWhere(['like', 'min_log', $this->min_log])
                ->andFilterWhere(['like', 'hh_min_log', $this->hh_min_log])
                ->andFilterWhere(['like', 'mm_min_log', $this->mm_min_log])
                ->andFilterWhere(['like', 'min_state_log', $this->min_state_log])
                ->andFilterWhere(['like', 'max_log', $this->max_log])
                ->andFilterWhere(['like', 'hh_max_log', $this->hh_max_log])
                ->andFilterWhere(['like', 'mm_max_log', $this->mm_max_log])
                ->andFilterWhere(['like', 'max_state_log', $this->max_state_log])
                ->andFilterWhere(['like', 'attendance_time', $this->attendance_time]);
            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $query->asArray()->all(),
                'pagination'=>[
                    'pageSize'=>-1
                ],
                'sort'=>$sort
            ]);
        }else{
            // die();
            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $query->where('0=1')->asArray()->all(),
                'pagination'=>[
                    'pageSize'=>-1
                ],
                'sort'=>$sort
            ]);
        }
        

        

        return $dataProvider;
    }
}
