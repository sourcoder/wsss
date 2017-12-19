<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    /**
     * @return array the validation rules.
     */
    public $content;
    public function rules()
    {
        return [
            [['file'], 'file'],
            [['file'], 'file', 'skipOnEmpty' => false],
            [['file'], 'file', 'extensions' => 'doc, docx, ppt, pptx'],
        ];
    }
    
    public function upload()
    {
        $this->content['Zpathurl'] = 'summary/'.date('Ymd', time());
        if ($this->validate()) {
            if (!file_exists($this->content['Zpathurl']))
            {
                mkdir('summary/'.date('Ymd', time()),0777,true);
            }
            	
            $this->content['Zpathurl'] = $this->content['Zpathurl'].'/' . $this->getUniqName(). '.' . $this->file->extension;
            if($this->file->saveAs($this->content['Zpathurl']))
            {
                $this->content['type'] = $this->file->extension;
                $this->content['title'] = $this->file->baseName;
                return $this->content;
            }else {
                return false;
            }
            	
        } else {
            return false;
        }
    }
    
    private function getUniqName()
    {
        return md5(uniqid(microtime(true),true));
    }
    
    public function attributeLabels()
    {
        return [
            'file' => '选择文件'
        ];
    }
}