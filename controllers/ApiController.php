<?php

namespace app\controllers;

use app\models\DataTransition;
use app\models\DataTransitionSearch;
use Extead\UAParser\UAParser;
use DateTime;
use Yii;
use app\models\Link;
use app\models\LinkSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use DateInterval;
use yii\helpers\Json;

/**
 * ApiController implements the CRUD actions for Link model.
 */
class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * Lists all Link models.
     * @return mixed
     */
    public function actionIndex()
    {

//        phpinfo();

        if(Yii::$app->request->url != '/'){

            $url = Yii::$app->request->absoluteUrl;
            $modelLink = Link::find()->where(['new_name' => $url])->one();
            if($modelLink) {

                $date = new DateTime();
                $dateNow = $date->format('Y-m-d');

                $modelBrowser = new UAParser();
                $arrBrowser = $modelBrowser->getBrowser();
                $dataBrowser = $arrBrowser['name'];

                $modelDataTransition = new DataTransition();
                $modelDataTransition->date_transition = $date->format('Y-m-d H:i:s');
                $modelDataTransition->date = $date->format('Y-m-d');
                $modelDataTransition->browser = $dataBrowser;
                $modelDataTransition->ip_address = Yii::$app->request->userIP;
                $modelDataTransition->referer = Yii::$app->request->referrer;
                $modelDataTransition->link_id = $modelLink->id;

                $modelDataTransition->save();

                if ($modelLink->original_name && (strtotime($dateNow) < strtotime($modelLink->date_end)) && $modelLink->status != 0) {

                    Yii::$app->response->redirect($modelLink->original_name);
                }
                else
                    echo (Json::encode('Error 404'));
            }
            else
                echo (Json::encode('Error 404'));
        }
        else
            echo (Json::encode("API's instructions"));
    }




    /**
     * Creates a new Link model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Link();

        if ($model->load(Yii::$app->request->get(), '') && $model->validate() ) {

            $host = $_SERVER['REQUEST_SCHEME'] . '://' . Yii::$app->request->headers['host'];

            $randomStr = (preg_replace('[-]', '', Yii::$app->security->generateRandomString(10)));
            $model->new_name = $host . '/' . $randomStr;

            $date = new DateTime();
            $model->date_create = $date->format('Y-m-d');

            Yii::$app->request->get('days')  ? $dateInterval = $date->add(new DateInterval('P' . $model->days . 'D')) : $dateInterval = $date->add(new DateInterval('P' . Link::DAYS . 'D'));
            $model->date_end = $dateInterval->format('Y-m-d');

            $model->save();

            echo (Json::encode($model->new_name));

        }
        else{
            echo (Json::encode('No parameters'));
        }
    }

    /**
     * Updates an existing Link model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id = 0)
    {

        if(Yii::$app->request->get('id')){
            $modelLink = $this->findModel($id);

            if($modelLink) {

                if ($modelLink->load(Yii::$app->request->get(), '')) {

                    $date = new DateTime();
                    $modelLink->date_create = $date->format('Y-m-d');

                    Yii::$app->request->get('days')  ? $dateInterval = $date->add(new DateInterval('P' . $modelLink->days . 'D')) : $dateInterval = $date->add(new DateInterval('P' . Link::DAYS . 'D'));
                    $modelLink->date_end = $dateInterval->format('Y-m-d');

                    $modelLink->save();
                    echo (Json::encode('Update is successful'));

                }
            }
        }
        else
            echo (Json::encode('No parameters'));
    }

    /**
     * Deletes an existing Link model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id = 0)
    {

        if(Yii::$app->request->get('id')) {
            $modelLink = $this->findModel($id);

            if(ArrayHelper::getValue($modelLink, 'id')) {
                $modelLink->delete();
                echo (Json::encode('Delete is successful'));
            }
        }
        else
            echo (Json::encode('No parameters'));

    }


    public function actionStatistic($id = 0){

        if(Yii::$app->request->get('id')){
            $arrStatistic = DataTransition::getDataTransition($id);
            echo (Json::encode($arrStatistic));
        }
        else
            echo (Json::encode('No parameters'));


    }


    public function actionSearchLink(){

        $modelSearch = new LinkSearch();
        $dataProvider = $modelSearch->search(Yii::$app->request->queryParams);
        $modelLink = $dataProvider->getModels();

        echo (Json::encode($modelLink));


    }


    public function actionSearchDataTransition(){

        $modelSearch = new DataTransitionSearch();
        $dataProvider = $modelSearch->search(Yii::$app->request->queryParams);
        $modelDataTransition = $dataProvider->getModels();

        echo (Json::encode($modelDataTransition));

    }

    /**
     * Finds the Link model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Link the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Link::findOne($id)) !== null) {
            return $model;
        }
        echo (Json::encode('Model does not exist'));

    }

    public function actionError(){
        echo (Json::encode('Error 404'));
        exit();
    }


}
