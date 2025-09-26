<?php

namespace app\controllers;

use app\models\Application;
use app\models\Courses;
use app\models\Feedback;
use app\models\PayType;
use app\models\Status;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use Yii;
use yii\bootstrap5\ActiveForm;
use yii\web\Response;

/**
 * AccountController implements the CRUD actions for Application model.
 */
class AccountController extends Controller
{
    /**
     * @inheritDoc
     */


    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function beforeAction($action)
    {
        // your custom code here, if you want the code to run before action filters,
        // which are triggered on the [[EVENT_BEFORE_ACTION]] event, e.g. PageCache or AccessControl

        if (!parent::beforeAction($action)) {
            return false;
        }

        // if (Yii::$app->user->isGuest || Yii::$app->user->identity->isAdmin) {
        //     return $this->redirect('/');
        // }

        if (! Yii::$app->user->identity?->isClient) {
            return $this->redirect('/');
        }
        // if (Yii::$app->user?->identity->isAdmin) {
        //     return $this->redirect('/');
        // }

        // other custom code here

        return true; // or false to not run the action
    }

    /**
     * Lists all Application models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Application::find()->where(['user_id' => Yii::$app->user->id]),

            'pagination' => [
                'pageSize' => 5
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'id' => SORT_DESC,
            //     ]
            // ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Application model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Application();

        $courses = Courses::getCourses();
        $payType = PayType::getPayType();

        if ($this->request->isPost) {
            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            $model->user_id = Yii::$app->user->id;
            $model->status_id = Status::getStatusId('new');
            if ($model->load($this->request->post()) && $model->validate()) {
                $date = date_create($model->data_start);
                $model->data_start = date_format($date, "Y-m-d");


                // VarDumper::dump($model->attributes, 10, true); die;
                // return $this->redirect(['view', 'id' => $model->id]);
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Заявка успешно добавлена!');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                VarDumper::dump($model->errors, 10, true);
                VarDumper::dump($model->attributes, 10, true);
                die;
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'courses' => $courses,
            'payType' => $payType,
        ]);
    }



    /**
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFeedback($id)
    {
        $model = new Feedback();
        $model->application_id = $id;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Отзыв о курсе успешно добавлена!');

            return $this->redirect(['view', 'id' => $model->application_id]);
        }

        return $this->render('Feedback', [
            'model' => $model,
        ]);
    }
}
