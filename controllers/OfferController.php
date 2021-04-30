<?php

namespace app\controllers;

use app\models\Project;
use Yii;
use app\models\Offer;
use app\models\OfferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OfferController implements the CRUD actions for Offer model.
 */
class OfferController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Offer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Offer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Offer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $project
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->getUser()->getIsGuest()) $this->redirect(['../site/login']);

        $model = new Offer();

        //Сделать проверку на существующий offer

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->status = 'ssooo';
            return $this->redirect(['../project/view', 'id' => $model->project_id]);
        }

//        if ($model = $this->findModelByParametrs($project_id, Yii::$app->getUser()->getId()) == null) {
//            $model = new Offer();
//            $model->project_id = $project_id;
//            $model->performer_id =  Yii::$app->getUser()->getId();
//            $model->date = date("Y-m-d");
//            $model->status = "Отправлено";
//        }

        //var_dump($model);
        //$model = $this->findModelByParametrs($project, Yii::$app->getUser()->getId()) !== null ? : new Offer();


        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //    return $this->redirect(['../project/view', 'id' => $model->project_id]);
            //return $this->redirect(['view', 'id' => $model->id]);
        //}

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Offer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'modal';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(Yii::$app->request->referrer);
            return $this->goBack();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Offer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->performer_id != Yii::$app->getUser()->getId()) $this->redirect(['../site/login']);

        $project_id = $model->project_id;
        $model->delete();
        return $this->redirect(['../project/view', 'id' => $project_id]);
    }

    /**
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $project
     * @param integer $performer
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByParametrs($project, $performer)
    {
        if ($model = Offer::find()->where(['project_id' => $project, 'performer_id' => $performer])->one())
            return $model;
        //throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*
     * @param integer $id
     */
    protected function findModel($id)
    {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

//    public function actionOffersToProject($project) {
//        if (Yii::$app->getUser()->getIsGuest()) $this->redirect(['../site/login']);
//
//        $offers = Offer::find()->where(['project_id' => $project])->all();
//
//        return $this->render('offers-to-project', [
//            'models' => $offers,
//            'project_id' => $project,
//            'author' => Yii::$app->getUser()->getId()]);
//    }

    public function actionAccept($project_id, $offer_id) {
        if (Yii::$app->getUser()->getIsGuest()) $this->redirect(['../site/login']);

        $offer = $this->findModel($offer_id);

        $project = Project::find()->where(['id' => $project_id])->one();
        $project->task_status = "В процессе";
        $project->performer_id = $offer->performer_id;
        $project->save();

        return $this->redirect(Yii::$app->request->referrer);

        //Если будет добавлен статус к предложениям
        // $offer->status = “Статус”;

    }
}
