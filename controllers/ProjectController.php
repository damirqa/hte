<?php

namespace app\controllers;

use app\models\Offer;
use app\models\Profile;
use Yii;
use app\models\project;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Проекты
     */
    public function actionIndex()
    {
        return  $this->render('index');
    }

    /**
     * Displays a single project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Url::remember();
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


    /*
     * ИСПОЛЬЗУЕТСЯ
     *
     * Создаем объект "Проект"
     * Только для авторизованных пользователей.
     */
    public function actionCreate()
    {
        $model = new Project();                                                                                         // Создаем модель Project, чтобы записать данные из формы

        if ($model->load(Yii::$app->request->post()) && $model->save()) {                                               // Проверяем, что данные из формы загрузились сохранились в модели
            if ($model->imageFiles = UploadedFile::getInstances($model, 'imageFiles')) {                        // Проверяем, что загружаемые файлы сохранились в переменной imageFiles модели Project

                if (!file_exists('files/project/' . $model->id)) {                                              // Если отсутствует папка для хранения файлов проекта
                    FileHelper::createDirectory('files/project/' . $model->id);                                    // Создаем папку для хранения файлов проекта
                }

                $links = '';                                                                                            // Храним все ссылки на файлы

                foreach ($model->imageFiles as $file) {                                                                 // Обрабатываем каждый файл
                    $link = 'files/project/'  . $model->id . '/' . $file->baseName . '.' . $file->extension;            // Формируем ссылку на хранения файла
                    $file->saveAs($link);                                                                               // Сохраняем файл по ссылке $link
                    $links .= $link . ';';                                                                              // Ссылку сохраняем в месте для всех ссылок. Ссылки разделяются точкой с запятой
                }
                $model->files_link = $links;                                                                            // Записываем все ссылки в модель
            }

            $model->date = date("Y-m-d");                                                                        // Записываем дату создания проекта
            $model->customer_id = Yii::$app->getUser()->getId();                                                        // Записываем ИД пользователя, как ИД заказчика
            $model->task_status = "Открыт";                                                                             // Устанавливаем статус проекта

            $model->save(false);                                                                             // Сохраняем изменения в модели
            return $this->redirect(['view', 'id' => $model->id]);                                                       // Перенаправляем на только что созданную страницу
        }

        return $this->render('create', [                                                                           // Если данные из формы не загрузились, то возвращаем форму модели
            'model' => $model,
        ]);
    }


    /**
     * ИСПОЛЬЗУЕТСЯ
     *
     * Редактируем объект "Проект"
     * Только для авторизованных людей
     * Только для владельцев
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->customer_id == Yii::$app->getUser()->getId()) {                                                     // Проверяем, что пользователь является владельцем объекта Проект
            if ($model->load(Yii::$app->request->post()) && $model->save()) {                                           // Загружаем данные из формы в модель и сохраняем в БД
                if ($model->imageFiles = UploadedFile::getInstances($model,'imageFiles')) {                     // Проверяем, что есть загруженные файлы

                    if (!file_exists('files/project/' . $model->id)) {                                          // Если отсутствует папка для хранения файлов проекта
                        FileHelper::createDirectory('files/project/' . $model->id);                                // Создаем папку для хранения файлов проекта
                    }

                    $links = '';                                                                                        // Храним все ссылки на файлы

                    foreach ($model->imageFiles as $file) {                                                             // Обрабатываем каждый файл
                        $link = 'files/project/'  . $model->id . '/' . $file->baseName . '.' . $file->extension;        // Формируем ссылку на хранения файла
                        $file->saveAs($link);                                                                           // Сохраняем файл по ссылке $link
                        $links .= $link . ';';                                                                          // Ссылку сохраняем в месте для всех ссылок. Ссылки разделяются точкой с запятой
                    }
                    $model->files_link = $links;                                                                        // Записываем все ссылки в модель
                }

                $model->save(false);                                                                         // Сохраняем модель
                return $this->redirect(['view', 'id' => $model->id]);                                                   // Редирект на представление модели
            }

            return $this->render('update', [                                                                       // Если данные из формы не загружены, то возвращаем форму для загрузки
                'model' => $model,
            ]);
        }
        else {
            throw new HttpException(403, 'Forbidden');                                                    // Выводим ошибку если это не владелец объекта Проект
        }
    }

    /**
     * ИСПОЛЬЗУЕТСЯ
     *
     * Удаляет существующий проект
     * Только для владельцев объекта Проект
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);                                                                                 // Находим модель

        if ($model->customer_id == Yii::$app->getUser()->getId()) {                                                     // Проверяем, что пользователь является владельцем
            $model->delete();                                                                                           // Удаляем модель
        }
        else {
            throw new HttpException(403, 'Forbidden');                                                    // Выводим ошибку, если пользователь не является владельцем
        }

        return $this->redirect(['index']);                                                                              // Редирект на главную страницу
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

    public function actionOffers($id) {
        if (Yii::$app->getUser()->getIsGuest()) $this->redirect(['../site/login']);

        $model = $this->findModel($id);
        if (Yii::$app->getUser()->getId() == $model->customer_id) {
            $offers = Offer::find()->where(['id' => $id])->andWhere(['not', ['status' => 'Отклонен']])->all();
            return $this->render('offers', [
                'offers' => $offers,
                'model' => $model,
                'customer' => Yii::$app->getUser()->getId()]);
        }
        else {
            return $this->goHome();
        }
    }

    public function actionGetOffersJson($id) {
        $offers = Offer::findAll(['project_id' => $id]);
        $data = [];
        foreach ($offers as $offer) {
            $performer = Profile::find()->where(['id' => $offer->performer_id])->one();
            $data[] = [
                'id' => $offer->id,
                'performer_id' => $performer->id,
                'performer' => ($performer->surname != '' || $performer->name != '')
                                    ? $performer->surname . " " . $performer->name
                                    : explode('@', $performer->email)[0],
                'text' => $offer->text,
                'date' => date_format(new \DateTime($offer->date), "d.m.Y") ,
                'bid' => is_null($offer->bid) ? "Договорная" : $offer->bid,
                'date-exec' => date_format(new \DateTime($offer->scheduled_time_performer), "d.m.Y")
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->asJson($data);
    }

    public function actionAccept($p, $c, $o) {
        if (Yii::$app->getUser()->getId() == $c) {
            $offer = Offer::findOne($o);
            $offer->status = 'Принят';
            $offer->save();

            $project = $this->findModel($p);
            $project->performer_id = $offer->performer_id;
            $project->offer_id = $offer->id;
            $project->task_status = "В процессе";
            $project->save();

            return $this->redirect('/project/view?id=' . $p);
        }
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
