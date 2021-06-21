<?php

namespace app\controllers;

use Yii;
use app\models\Profile;
use app\models\Project;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class ProfileController extends Controller
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

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Profile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /*
     * ИСПОЛЬЗУЕТСЯ
     */
    private function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*
     * ИСПОЛЬЗУЕТСЯ
     *
     * Возвращает профиль текущего профиля
     */
    public function actionIndex() {
        $id = Yii::$app->getUser()->getId();
        $model = $this->findModel($id);

        return $this->render('profile', [
            'model' => $model
        ]);
    }

    /*
     * ИСПОЛЬЗУЕТСЯ
     *
     * Обновление профиля пользователя
     */
    public function actionUpdate() {
        $model = $this->findModel(Yii::$app->getUser()->getId());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->imageFile = UploadedFile::getInstance($model, 'imageFile')) {
                if (!file_exists('img/profile/' . $model->id)) {
                    FileHelper::createDirectory('img/profile/' . $model->id);
                }
                $path = 'img/profile/' . $model->id . '/' . $model->imageFile->baseName . '.' . $model->imageFile->extension;
                $model->imageFile->saveAs($path, false);
                $model->photo_link = '../' . $path;
            }
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionJobsJson() {
        $models = Project::findAll(['customer_id' => Yii::$app->getUser()->getId()]);
        $json = [];
        foreach ($models as $model) {
            $json[] = [
                'id' => $model->id,
                'title' => $model->title,
                'type' => $model->type,
                'annotation' => $model->annotation,
                'description' => $model->description,
                'date' => date_format(new \DateTime($model->date),"d.m.Y"),
                'price' => $model->price,
                'task_status' => $model->task_status
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->asJson($json);
    }

    public function actionJobs() {
        return $this->render('jobs');
    }
}