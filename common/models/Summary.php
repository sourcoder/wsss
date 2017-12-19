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
        $this->Ztime = date("Y-m-d", time());
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
    	->all();;
        return $data;
    }
}
