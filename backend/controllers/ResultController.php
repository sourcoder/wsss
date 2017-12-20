<?php
namespace backend\controllers;
use yii\filters\AccessControl;
use Yii;
use common\models\Teacher;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Summary;
use common\models\G;
class ResultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex() {
        $teacher = new Teacher();
        $summary = new Summary();
        $g = new G();
        $teachers = $teacher->getAllTeacher();
        foreach ($teachers as $one) {
             //得到最新上传的summary记录
            $s = $summary->getLastestSummaryByTid($one['Tid']);
            $score = $g->getAllGByZid($s['Zid']);
            
            //遍历所有分数记录
            $count = 0; //统计机关老师评价个数
            $teacherSum = 0;
            $advicerSum = 0;
            //var_dump($score);
            foreach ($score as $single) {
                if(!$single['Gsuggestion']) {
                    $advicerSum += $single['GScore'];
                    $count++;
                }else {
                    $teacherSum += $single['GScore'];
                }
            }
           // var_dump($count);
            //var_dump((count($score)-$count));
            //exit();
            $data[] = [
                'teacher' => number_format($teacherSum / $count, 2), 
                'advicer' => number_format($advicerSum/(count($score)-$count), 2), 
                'result' => number_format($teacherSum / $count * 0.4 +  $advicerSum/(count($score)-$count) * 0.6, 2),
                'name' => $teacher->getNameByTid($one['Tid'])
            ];
        }
        //var_dump($data);//exit();
        return $this->render('index',
            [
                'data'=>$data,
            ]);
    }
}