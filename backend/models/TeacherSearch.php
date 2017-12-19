<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Teacher;

/**
 * TeacherSearch represents the model behind the search form about `backend\models\Teacher`.
 */
class TeacherSearch extends Teacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tid', 'Ttype'], 'integer'],
            [['Tname', 'Taccount', 'Tpassword', 'Tgender', 'Tbirthday', 'Tphoto', 'Ttitle', 'Temail', 'Tdepartment'], 'safe'],
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
        $query = Teacher::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Tid' => $this->Tid,
            'Tbirthday' => $this->Tbirthday,
            'Ttype' => $this->Ttype,
        ]);

        $query->andFilterWhere(['like', 'Tname', $this->Tname])
            ->andFilterWhere(['like', 'Taccount', $this->Taccount])
            ->andFilterWhere(['like', 'Tpassword', $this->Tpassword])
            ->andFilterWhere(['like', 'Tgender', $this->Tgender])
            ->andFilterWhere(['like', 'Tphoto', $this->Tphoto])
            ->andFilterWhere(['like', 'Ttitle', $this->Ttitle])
            ->andFilterWhere(['like', 'Temail', $this->Temail])
            ->andFilterWhere(['like', 'Tdepartment', $this->Tdepartment]);

        return $dataProvider;
    }
}
