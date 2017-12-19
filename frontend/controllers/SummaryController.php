<?php

namespace frontend\controllers;

use frontend\models\UploadForm;
use Yii;
use yii\web\UploadedFile;
use common\models\Summary;
use common\models\Teacher;

class SummaryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('upload');
    }
    
    
    public function actionUpload($tid)
    {
        $fileModel = new UploadForm();
        $summaryModel = new Summary();
        $summary = $summaryModel->getAllSummary($tid);
        $teacher = new Teacher();
        $name = $teacher->getNameByTid($tid);
        $data = [];
        for($i=0; $i < count($summary); $i++) {
            $data[$i]['Zpathurl'] = '/'.$summary[$i]['Zpathurl'];
            $data[$i]['filename'] = $name.$summary[$i]['Ztime'];
        }
//         foreach ($summary as $item) {
//             $data['Zpathurl'][] = $item['Zpathurl'];
//             $data['filename'][] = $item['Ztime'];
//         }
       // print_r($data);exit();
        if (Yii::$app->request->isPost) {
            $fileModel->file = UploadedFile::getInstance($fileModel, 'file');
            $content = $fileModel->upload();
            if ($content) {
                $post = Yii::$app->request->post();
                $content['tid'] = $tid;
                $res = $summaryModel->saveData($content, $post);
                if ($res)
                {
                    echo "<script>alert('文件上传成功');</script>";
                }else
                {
                    echo "<script>alert('文件上传失败')</script>";
                }
            }
            else {
                echo "<script>alert('"."文件上传失败".$fileModel->hasErrors()."')</script>";
            }
        }
        
        return $this->render('upload',
            [
                'fileModel'=> $fileModel,
                'data'=>$data,
            ]);
    }

}
