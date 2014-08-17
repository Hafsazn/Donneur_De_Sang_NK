<?php

class DonneurController extends Controller {

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
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('index', 'view',),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'recherche', 'profile', 'base', 'list', 'test','toggle'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
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

    public function actionTest() {
        header("Content-type: application/json");
        $verb = $_SERVER["REQUEST_METHOD"];
        $this->actionListPost();
    }

    /**
     * Function List
     * This function or actionget donneur data from database and write theme as json, it represente REST-Full web service
     *
     */
    public function actionList() {
        header("Content-type: application/json");
        $verb = $_SERVER["REQUEST_METHOD"];

        if ($verb === 'GET') {
            echo "{\"data\":" . CJSON::encode(Donneur::model()->findAll()) . "}";
        } else if ($verb == 'POST') {
            if (Donneur::model()->exists('id' === $_POST['id'])) {
                $this->actionListUpdate($_POST);
            } else {
                $this->actionListPost();
            }
        } else if ($verb == 'DELETE') {
            $this->actionListDelete();
        }
    }

    /**
     * thid function represente the post methode for the REST-full web service
     */
    private function actionListPost() {
        $donneur = new Donneur;
        $donneur->first_name = $_POST['first_name'];
        $donneur->last_name = $_POST['last_name'];
        $donneur->age = $_POST['age'];
        $donneur->gender = $_POST['gender'];
        $donneur->address = $_POST['address'];
        $donneur->phone = $_POST['phone'];
        $donneur->groupe_sangun = $_POST['groupe_sangun'];
        $donneur->email = $_POST['email'];
        $donneur->vehicle = $_POST['vehicle'];
        
        $donneur->date_donation = ($_POST['date_donation']==='1970-01-01') ? null : $_POST['date_donation'];
        if ($donneur->save()) {
            echo CJSON::encode($donneur);
        } else {
            header("HTTP/1.1 501 Internal Server Error");
            echo "Update failed for Donneur: ";
        }
    }

    private function actionListUpdate($post) {
        $donneur = $this->loadModel($post['id']);
        $donneur->first_name = $_POST['first_name'];
        $donneur->last_name = $_POST['last_name'];
        $donneur->age = $_POST['age'];
        $donneur->gender = $_POST['gender'];
        $donneur->address = $_POST['address'];
        $donneur->phone = $_POST['phone'];
        $donneur->groupe_sangun = $_POST['groupe_sangun'];
        $donneur->email = $_POST['email'];
        $donneur->vehicle = $_POST['vehicle'];
         $donneur->date_donation = ($_POST['date_donation']==='1970-01-01') ? null : $_POST['date_donation'];
        if ($donneur->save()) {
            echo CJSON::encode($donneur);
        } else {
            header("HTTP/1.1 101 Internal Server Error");
            echo "Update failed for Donneur: ";
        }
    }

    /**
     * thid function represente the put methode for the REST-full web service
     */
    private function actionListPut() {
        $put_vars = $this->actionListPutConvert();
        $donneur = $this->loadModel($put_vars['id']);
        $donneur->first_name = $put_vars['first_name'];
        $donneur->last_name = $put_vars['last_name'];
        $donneur->age = $put_vars['age'];
        $donneur->gender = $put_vars['gender'];
        $donneur->address = $put_vars['address'];
        $donneur->phone = $put_vars['phone'];
        $donneur->groupe_sangun = $put_vars['groupe_sangun'];
        $donneur->vehicle = $put_vars['vehicle'];

        if ($donneur->save()) {
            header("HTTP/1.1 200 ok");
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo "Update failed for EmployeeID: ";
        }
    }

    /**
     * 
     * @return type array of data
     */
    private function actionListPutConvert() {
        $json = file_get_contents('php://input');
        $put = explode('&', $json);
        $put_vars = array();
        foreach ($put as $value) {
            $var = explode('=', $value);
            $put_vars[$var[0]] = $var[1];
        }
        echo CJSON::encode($put_vars);
        return $put_vars;
    }

    /*
     * this function handel the delete verb
     */

    private function actionListDelete() {
        $put_vars = $this->actionListPutConvert();
        $this->loadModel($put_vars['id'])->delete();
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Donneur;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Donneur'])) {
            $model->attributes = $_POST['Donneur'];
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
    public function actionUpdate() {
        Yii::import('bootstrap.widgets.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('Donneur');  // 'User' is classname of model to be updated
        $es->update();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        /*if (isset($_POST['pk'])) {
            $model = $this->loadModel($_POST['pk']);
            $model->first_name = $_POST['first_name'];
            $model->save();
              // $this->redirect(array('view', 'id' => $model->id));
        }

      /*  $this->render('update', array(
            'model' => $model,
        ));*/
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Donneur');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Donneur('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Donneur']))
            $model->attributes = $_GET['Donneur'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Donneur the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Donneur::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Donneur $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'donneur-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionRecherche() {
        $this->layout = '//layouts/column1';
        $model = new Donneur('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Donneur'])) {
            $model->attributes = $_GET['Donneur'];
        }

        $this->render('recherche', array(
            'model' => $model,
        ));
    }

    public function actionBase() {
        $this->layout = '//layouts/column1';
        $this->render('base');
    }

    public function actionProfile() {
        $this->render('profile');
    }

    public function actions() {
        return array(
            'toggle' => array(
                'class' => 'bootstrap.actions.TbToggleAction',
                'modelName' => 'Donneur',
                'yesValue' => 'Oui',
                'noValue' => 'Non',
            )
        );
    }

}
