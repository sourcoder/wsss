<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "summary".
 *
 * @property integer $Zid
 * @property integer $Tid
 * @property string $Ztime
 * @property integer $Zpathurl
 */
class Summary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tid', 'Ztime', 'Zpathurl'], 'required'],
            [['Tid', 'Zpathurl'], 'string'],
            [['Ztime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Zid' => 'Zid',
            'Tid' => 'Tid',
            'Ztime' => 'Ztime',
            'Zpathurl' => 'Zpathurl',
        ];
    }
    
    /**
     * 保存上传资料的相关信息
     * @param unknown $content
     * @param unknown $post
     * @return boolean
     */
    public function saveData($content, $post)
    {
         
//         $this->title = $content['title'];
//         $this->size = $content['size'];
//         $this->type = $content['type'];
//         $this->author = Yii::$app->user->identity->username;
//         $this->uploadtime = time();
//         $this->summary = $post['Libs']['summary'];
//         $this->publicity = $post['Libs']['publicity'];
//         $this->score =10;
//         $this->book_id = $content['book_id'];
        $this->Zpathurl = $content['Zpathurl'];
        $this->Tid = $content['tid'];
        date_default_timezone_set('PRC'); //设置中国时区
        $this->Ztime = date("Y-m-d H:i:s", time());
        if($this->save())
        {
            return true;
        }else {
            return false;
        }
    }
    
    
    public function getAllSummary($Tid) {
        
        $data = $this->find()
        ->where(['Tid' => $Tid])
        ->orderBy(['Ztime' => SORT_DESC])
        ->asArray()
    	->all();
        return $data;
    }
    
    /**
     * 得到所有老师的最新总结
     * @param unknown $teachers
     */
    public function getAllLastestSummary($ids) {
       
        $data = [];
        foreach ($ids as $Tid) {
            $data[] = $this->find()
                            ->where(['Tid' => $Tid])
                            ->orderBy(['Ztime' => SORT_DESC])
                            ->asArray()
                            ->all()[0];
        }
        return $data;
    }
    /**
     * 通过老师的id得到最新的summary
     * @param unknown $Tid
     */
    public function getLastestSummaryByTid($Tid) {
        $data = $this->find()
        ->where(['Tid' => $Tid])
        ->orderBy(['Ztime' => SORT_DESC])
        ->asArray()
        ->all();
        return $data[0];
    }
    
    /**
     * 通过总结的id得到老师的id
     * @param unknown $Zid
     */
    public function getTidByZid($Zid) {
        $data = $this->find()
        ->where(['Zid' => $Zid])
        ->asArray()
        ->all();
        return $data[0]['Tid'];
    }
    
    public function getZidsByTid($Tid) {
        $data = $this->find()
        ->where(['Tid' => $Tid])
        ->asArray()
        ->all();
        return $data;
    }
}
