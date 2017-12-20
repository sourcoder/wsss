<?php

namespace frontend\controllers;

use frontend\models\UploadForm;
use Yii;
use yii\web\UploadedFile;
use common\models\Summary;
use common\models\Teacher;
use common\models\G;
class SummaryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('upload');
    }
    
    /**
     * 总结上传函数
     * @param unknown $tid 老师的id
     */
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
        if (Yii::$app->request->isPost) {
            $fileModel->file = UploadedFile::getInstance($fileModel, 'file');
            $content = $fileModel->upload();
            if ($content) {
                $post = Yii::$app->request->post();
                $content['tid'] = $tid;
                $res = $summaryModel->saveData($content, $post);
                $summary = $summaryModel->getAllSummary($tid);
                $name = $teacher->getNameByTid($tid);
                $data = [];
                for($i=0; $i < count($summary); $i++) {
                    $data[$i]['Zpathurl'] = '/'.$summary[$i]['Zpathurl'];
                    $data[$i]['filename'] = $name.$summary[$i]['Ztime'];
                }
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
    
    
    public function actionAssess($tid){
        
        $data = $this->getSummaryList($tid);
        return $this->render('assess',
            [
                'data'=>$data,
            ]);
    }
    /**
     * 得到$tid对应老师，应该评价的总结列表
     * @param unknown $tid
     */
    public function getSummaryList($tid) {
        $teacher = new Teacher();
        //得到所有的机关老师的数据
        $teachers = $teacher->getAllTeacher();
        $ids = [];
        foreach ($teachers as $teacher) {
            $ids[] = $teacher['Tid'];
        }
        $summaryModel = new Summary();
        $teacher = new Teacher();
        $summarys = [];
        $names = [];    //得到所有被评价机关老师的名称
        if(count($teacher) <= 10) {
            $summarys = $summaryModel->getAllLastestSummary($ids);
            $names = $teacher->getNamesByTids($ids);
        }else {
            
            for($i=0; $i < 10; $i++) {
                $summarys[] = $summaryModel->getLastestSummaryByTid(($tid+i+1) % count($teachers));
                $names[] = $teacher->getNameByTid(($tid+i+1) % count($teachers));
            }
        }
        for($i=0; $i < count($names); $i++) {
            $data[$i]['name'] = $names[$i];
            $data[$i]['summary'] = $summarys[$i];
        }
        return $data;
    }

    /**
     * 评委或机关老师评分
     * @param unknown $Tid 评委或评分机关老师的id
     * @param unknown $Zid 被评分机关老师的总结id
     */
    public function actionScore($Tid, $Zid) {
        
        $teacher = new Teacher();
        $summary = new Summary();
        $teacherid = $summary->getTidByZid($Zid);
        $teacherinfo = $teacher->getTeacherInfoByTid($teacherid);
        $g = new G();
        $data['Tid'] = $Tid;
        $data['Zid'] = $Zid;
        if (Yii::$app->request->isPost) {
            $post = \Yii::$app->request->Post();
            //print_r($post);
            $data['GScore'] = $post['G']['GScore'];
            $data['Gsuggestion'] = array_key_exists('Gsuggestion', $post['G']) ? $post['G']['Gsuggestion']:null;
            if($g->saveData($data)) {
                echo "<script>alert('评分成功')</script>";
            }else {
                echo "<script>alert('评分失败')</script>";
            }
        }
        return $this->render('score',
            [
                'data'=>$teacherinfo,
                'g'=>$g,
                'Tid'=>$Tid,
            ]);
    }
}
