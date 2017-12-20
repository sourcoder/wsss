<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "g".
 *
 * @property integer $Tid
 * @property integer $Zid
 * @property integer $GScore
 * @property integer $Gsuggestion
 */
class G extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tid', 'Zid', 'GScore'], 'required'],
            [['Tid', 'Zid', 'GScore',], 'integer'],
            [['GScore'], 'integer', 'max'=>100, 'min'=>0],
            [['Gsuggestion'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tid' => 'Tid',
            'Zid' => 'Zid',
            'GScore' => '分数',
            'Gsuggestion' => '建议',
        ];
    }
    
    public function saveData($data) {
        $this->Tid = $data['Tid'];
        $this->Zid = $data['Zid'];
        $this->GScore = $data['GScore'];
        $this->Gsuggestion = $data['Gsuggestion'];
        if($this->save()) {
            return true;
        }else{
            return false;
        }
    }
    
    public function getAllGByZid($Zid) {
        $data = $this->find()
                ->where(['Zid' => $Zid])
                ->asArray()
                ->all();
        return $data;
    }
    
    public function getZidsByTid($Tid) {
        $data = $this->find()
        ->where(['Tid' => $Tid])
        ->asArray()
        ->all();
        return $data;
    }
}
