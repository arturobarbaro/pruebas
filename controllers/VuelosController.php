<?php

namespace app\controllers;

use app\models\Aeropuertos;
use app\models\Vuelos;
use app\models\VuelosSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * VuelosController implements the CRUD actions for Vuelos model.
 */
class VuelosController extends Controller
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
     * Lists all Vuelos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VuelosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listaOrigen' => $this->listaOrigen(),
        ]);
    }

    /**
     * Displays a single Vuelos model.
     * @param int $id
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
     * Creates a new Vuelos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vuelos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vuelos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
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
     * Deletes an existing Vuelos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vuelos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Vuelos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vuelos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBuscarAjax()
    {
        $searchModel = new VuelosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->renderAjax('_parcial', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRetrasar($id)
    {
        $vuelo = $this->findModel($id);
        $vuelo->salida = !empty($vuelo->salida) ? date('Y-m-d H:i:s') : null;
        $vuelo->save();
        return $this->redirect(['vuelos/index']);
    }
    public function actionAdelantar($id)
    {
        $vuelo = $this->findModel($id);
        $fecha = date('Y-m-d H:i:s');
        // o usar  (new \DateTime())->add(new \DateInterval('P2D'))->format('Y-m-d H:i:s')
        $vuelo->llegada = !empty($vuelo->llegada) ? date('Y-m-d H:i:s', strtotime($fecha . '+ 20 hours')) : null;
        $vuelo->save();
        return $this->redirect(['vuelos/index']);
    }

    public function listaOrigen()
    {
        //$listaOrigen = Vuelos::find()->select('origen')->joinWith('aeropuertos')->indexBy('aeropuertos.id')->column();
        return array_merge([''], Aeropuertos::find()->select('denominacion')->indexBy('id')->column());
    }
}
