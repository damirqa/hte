<?php

namespace app\controllers;

use app\models\Offer;
use app\models\OfferSearch;
use Yii;
use app\models\project;
use app\models\ProjectSearch;
use yii\db\Query;
use yii\filters\AccessControl;
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

        $offer = Offer::find()->where(['project_id' => $id, 'performer_id' => Yii::$app->getUser()->getId()])->one();

        return $this->render('view', [
            'model' => $model,
            'offer' => $offer
        ]);
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
