<?php

namespace backend\controllers;

use common\models\CsvUpload;
use common\models\Photos;
use Yii;
use common\models\Cars;
use common\models\SearchCars;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CarsController implements the CRUD actions for Cars model.
 */
class CarsController extends Controller
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
     * Lists all Cars models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model_csv = new CsvUpload();
        $searchModel = new SearchCars();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model_csv' => $model_csv
        ]);
    }

    /**
     * Displays a single Cars model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionImportCsv()
    {

        $model = new Cars();
        $model_csv = new CsvUpload();
        $model_csv->csv = UploadedFile::getInstance($model_csv, 'csv');

        if ( $model_csv->csv )
        {
            $time = time();

            $model_csv->csv->saveAs('uploads/' .$time. '.' . $model_csv->csv->extension);
            $model_csv->csv = 'uploads/' .$time. '.' . $model_csv->csv->extension;
            $model_csv->save();

            $handle = fopen($model_csv->csv, "r");
            $row = 1;
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {

                $model->id = NULL;
                $model->isNewRecord = true;
                $model->make = $data[5];
                $model->model = $data[6];
                $model->VIN = $data[1];
                $model->year = $data[4];
                $model->created_at = $time;
                $model->updated_at = $time;

                $model->save();

                $row++;
                $potos_sources = explode('|', $data[26]);

                foreach ($potos_sources as $potos_sources_Items) {
                    if($potos_sources_Items != "Photo Url List"){
                        $model_photo = new Photos();
//                        print_r($potos_sources_Items); die;
                        if(!empty($potos_sources_Items)) {
                            $img = file_get_contents($potos_sources_Items);
                            $img_info = pathinfo($potos_sources_Items);
                        }else{
                            continue;
                        }

                        if(!is_dir("images/{$data[5]}/{$data[6]}"))
                        {
                            mkdir("images/{$data[5]}/{$data[6]}",  0755, TRUE);
                            $save_to = 'images/' . $data[5] .'/'. $data[6]. '/' . $data[1] . '_' . $img_info['filename'] . '.' . $img_info['extension'];

                            $model_photo->id = NULL;
                            $model_photo->isNewRecord = true;
                            $model_photo->car_id = $model->id;
                            $model_photo->photo = 'images/' . $data[5] .'/'. $data[6]. '/' . $data[1] . '_' . $img_info['filename'] . '.' . $img_info['extension'];
                            $model_photo->created_at = $time;
                            $model_photo->updated_at = $time;
                            $model_photo->save();

                            if(file_put_contents($save_to, $img)) {
                                echo 'Save the file';
                            }
                            else echo 'Unable to save the file';

                        }else{
                            $save_to = 'images/' . $data[5] .'/'. $data[6]. '/' . $data[1] . '_' . $img_info['filename'] . '.' . $img_info['extension'];

                            $model_photo->id = NULL;
                            $model_photo->isNewRecord = true;
                            $model_photo->car_id = $model->id;
                            $model_photo->photo = 'images/' . $data[5] .'/'. $data[6]. '/' . $data[1] . '_' . $img_info['filename'] . '.' . $img_info['extension'];
                            $model_photo->created_at = $time;
                            $model_photo->updated_at = $time;
                            $model_photo->save();

                            if(file_put_contents($save_to, $img)) {
                                echo 'Save the file';
                            }
                            else echo 'Unable to save the file';

                        }

                    }
                }
            }

        }

        echo "data upload successfully";
        return $this->redirect(['view', 'id' => $model->id]);

    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cars model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cars();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cars model.
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
     * Deletes an existing Cars model.
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
     * Finds the Cars model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cars the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cars::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
