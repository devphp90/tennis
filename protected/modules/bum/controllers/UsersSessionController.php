<?php

class UsersSessionController extends BumController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'deletePhoto', 'deleteVideo'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new UsersSession;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->date = date('Y-m-d');
        if (isset($_POST['UsersSession'])) {
            $model->attributes = $_POST['UsersSession'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $flag = false) {
        Yii::import('application.extensions.image.Image');

        $model = $this->loadModel($id);

        # update guiders flag $page_id = 6;
        if ($flag)
            $guider_flag = true;
        else
            $guider_flag = CommonClass::guiderFlag(6);

        $uploaded_video = SessionVideos::model()->findAllByAttributes(array('session_id' => $id));
        $video_model = new SessionVideos;

        $uploaded_photo = SessionPhotos::model()->findAllByAttributes(array('session_id' => $id));
        $photo_model = new SessionPhotos();

        if ($model->user_id != Yii::app()->user->id && Yii::app()->user->type != "admin" && Yii::app()->user->type != "reviewer") {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UsersSession'])) {
            $model->attributes = $_POST['UsersSession'];

            if ($model->save())
                $this->redirect(array('update', 'id' => $model->id));
        }

        if (isset($_POST['SessionVideos'])) {
            $video_model->attributes = $_POST['SessionVideos'];
            $video_model->session_id = $id;
            $file = CUploadedFile::getInstance($video_model, 'file_name');
            $video_model->file_name = time() . $file->getName();
            $video_model->file_size = $file->getSize();
            $video_model->file_type = $file->getType();

            if ($video_model->save()) {
                $file->saveAs(Yii::app()->basePath . '/../videos/' . $video_model->file_name);
                $this->redirect(array('update', 'id' => $model->id));
            }
        }

        if (isset($_POST['SessionPhotos'])) {
            $photo_model->attributes = $_POST['SessionPhotos'];
            $photo_model->session_id = $id;
            $file = CUploadedFile::getInstance($photo_model, 'file_name');
            $photo_model->file_name = time() . $file->getName();
            $photo_model->file_size = $file->getSize();
            $photo_model->file_type = $file->getType();

            if ($photo_model->save()) {
                $file->saveAs(Yii::app()->basePath . '/../photos/' . $photo_model->file_name);
                $image = Yii::app()->image->load('photos/' . $photo_model->file_name);
                $image->resize(200, 200)->crop(150, 150)->quality(80)->sharpen(20);
                $image->save('photos/thumb/' . $photo_model->file_name); // or $image->save('images/small.jpg');
                $this->redirect(array('update', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'video_model' => $video_model,
            'uploaded_video' => $uploaded_video,
            'photo_model' => $photo_model,
            'uploaded_photo' => $uploaded_photo,
            'guider_flag' => $guider_flag
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            if ($model->user_id != Yii::app()->user->id && Yii::app()->user->type != "admin") {
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $c = new CDbCriteria();
        $c->condition = 'user_id=:user';
        $c->params = array(':user' => Yii::app()->user->id);

        $dataProvider = new CActiveDataProvider('UsersSession', array('criteria' => $c));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new UsersSession('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UsersSession']))
            $model->attributes = $_GET['UsersSession'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = UsersSession::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-session-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDeletePhoto() {
        if (isset($_POST['id'])) {
            $model = SessionPhotos::model()->findByPk($_POST['id']);
            $photoPath = Yii::app()->basePath . '/../photos/';
            if ($model != null) {
                @unlink($photoPath . $model->file_name);
                @unlink($photoPath . 'thumb/' . $model->file_name);
            }
            $model->delete();
        }
    }

    public function actionDeleteVideo() {
        if (isset($_POST['id'])) {
            $model = SessionVideos::model()->findByPk($_POST['id']);
            $photoPath = Yii::app()->basePath . '/../videos/';
            if ($model != null) {
                @unlink($photoPath . $model->file_name);
            }
            echo $model->delete();
        }
    }

}
