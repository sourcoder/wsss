<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property integer $Tid
 * @property string $Tname
 * @property string $Taccount
 * @property string $Tpassword
 * @property string $Tgender
 * @property string $Tbirthday
 * @property string $Tphoto
 * @property string $Ttitle
 * @property string $Temail
 * @property string $Tdepartment
 * @property integer $Ttype
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['Tname', 'Taccount', 'Tpassword', 'Tgender', 'Tbirthday', 'Tphoto', 'Ttitle', 'Temail', 'Tdepartment', 'Ttype'], 'required'],
            [['Tname', 'Taccount', 'Tpassword', 'Tgender', 'Tbirthday', 'Tphoto', 'Ttitle', 'Temail', 'Tdepartment', 'Ttype'], 'required'],
            [['Tbirthday'], 'safe'],
            [['Ttype'], 'integer'],
            [['Tname', 'Ttitle'], 'string', 'max' => 10],
            [['Taccount', 'Tpassword'], 'string', 'max' => 20],
            [['Tgender'], 'string', 'max' => 4],
            [['Tphoto', 'Tdepartment'], 'string', 'max' => 100],
            [['Temail'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tid' => 'Tid',
            'Tname' => '姓名',
            'Taccount' => '账号',
            'Tpassword' => '密码',
            'Tgender' => '性别',
            'Tbirthday' => '生日',
            'Tphoto' => '照片',
            'Ttitle' => '职称',
            'Temail' => '邮箱',
            'Tdepartment' => '分管工作',
            'Ttype' => '系统身份',
        ];
    }
    
    public function getNameByTid($Tid) {
        $data = $this->find()
        ->where(['Tid' => $Tid])
        ->asArray()
        ->all();;
        return $data[0]['Tname'];
    }
}
