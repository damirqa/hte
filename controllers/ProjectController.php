<?php

namespace app\controllers;

use app\models\Offer;
use app\models\Profile;
use Yii;
use app\models\project;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for project model.
 */
class ProjectController extends Controller
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
     * Lists all project models.
     * @return mixed
     */
    public function actionIndex($id = 1)
    {
        if (is_null($id) | !is_integer($id) | empty($id)) $id = 1;

        $count = Project::find()->where(['task_status' => 'Открыт'])->count();
        $page_size = 5;
        $pages = ceil($count / $page_size);

        $projects = Project::find()
            ->where(['task_status' => 'Открыт'])
            ->orderBy('date DESC')
            ->limit($page_size)
            ->offset($id - 1)
            ->all();

        return $this->render('index', [
           'projects' => $projects,
           'page' => $id,
           'pages' => $pages
        ]);

//        $searchModel = new ProjectSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
    }

    /**
     * Displays a single project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->getUser()->getId() != $model->customer_id) {
            $offer = Offer::find()->where(['project_id' => $id, 'performer_id' => Yii::$app->getUser()->getId()])->one();

            return $this->render('view', [
                'model' => $model,
                'offer' => $offer
            ]);
        }

        if (Yii::$app->getUser()->getId() == $model->customer_id) {
            $offers = Offer::find()->where(['project_id' => $model->id])->all();
            $count_offers = Offer::find()->where(['project_id' => $model->id])->count();
            $offer = null;
            $performer = null;

            if (!is_null($model->offer_id)) {
                $offer = Offer::findOne($model->offer_id);
                $performer = Profile::findOne($offer->performer_id);
            }

            return $this->render('view', [
                'model' => $model,
                'offer' => $offer,
                'offers' => $offers,
                'count' => $count_offers,
                'performer' => $performer
            ]);
        }
    }

    /**
     * Creates a new project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->getUser()->getIsGuest()) return $this->redirect('/site/login');

            //var_dump($model);
            $model->date = date("Y-m-d");
            $model->customer_id = Yii::$app->getUser()->getId();
            $model->task_status = "Открыт";

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionGetProjectsJson() {
        $models = Project::findAll(['task_status'=>'Открыт']);
        //$models = Project::find()->all();
        $dataSson = [];
        foreach ($models as $model) {
            $dataSson[] = [
                'id' => $model->id,
                'title' => $model->title,
                'type' => $model->type,
                'annotation' => $model->annotation,
                'description' => $model->description,
                'date' => date_format(new \DateTime($model->date),"d.m.Y"),
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $this->asJson($dataSson); //json_encode($dataSson);
    }

    /**
     * Deletes an existing project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionOffers($id) {
        if (Yii::$app->getUser()->getIsGuest()) $this->redirect(['../site/login']);

        $model = $this->findModel($id);
        if (Yii::$app->getUser()->getId() == $model->customer_id) {
            $offers = Offer::find()->where(['id' => $id])->all();
            return $this->render('offers', [
                'offers' => $offers,
                'model' => $model,
                'customer' => Yii::$app->getUser()->getId()]);
        }
    }

    public function actionGetOffersJson($id) {
        $offers = Offer::findAll(['project_id' => $id]);
        $data = [];
        foreach ($offers as $offer) {
            $performer = Profile::find()->where(['id' => $offer->performer_id])->one();
            $data[] = [
                'performer_id' => $performer->id,
                'performer' => $performer->surname . " " . $performer->name,
                'text' => $offer->text,
                'date' => date_format(new \DateTime($offer->date), "d.m.Y") ,
                'bid' => $offer->bid,
                'date-exec' => date_format(new \DateTime($offer->scheduled_time_performer), "d.m.Y")
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->asJson($data);
    }

    /**
     * Finds the project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
