<?php

class DeliveyInfoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','findbycode', 'find', 'updateajax', 'create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DeliveyInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeliveyInfo']))
		{
			$model->attributes=$_POST['DeliveyInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeliveyInfo']))
		{
			$model->attributes=$_POST['DeliveyInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $data = array();
        $data["myValue"] = "Данные загружены";

        $this->render('find', $data);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DeliveyInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DeliveyInfo']))
			$model->attributes=$_GET['DeliveyInfo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DeliveyInfo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DeliveyInfo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DeliveyInfo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='delivey-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function ActionFindByCode()
    {
        var_dump($_GET);
       // $model=new DeliveyInfo;
       /* $posts=DeliveyInfo::model()->findAllBySql("select * from deliveyinfo where code
like '%:keyword%'", array(':keyword'=>$_POST['Text']));*/
        $this->render('_find');
    }


    public function actionFind()
    {
        $data = array();
        $data["myValue"] = "Данные загружены";

        $this->render('find', $data);
    }

    public function actionUpdateAjax()
    {
       // var_dump($_POST);
        $model=new DeliveyInfo();
        $rows =Yii::app()->db->createCommand()
            ->select('fio, date, adress, status_name')
            ->from('delivey_info u')
            ->join('status_info p', 'u.status_id=p.status_id')
            ->where('code=:code', array(':code'=>$_POST['word']))
            ->queryRow();

        $this->renderPartial('_ajaxContent',array(
            'model'=>$model,'rows'=>$rows,
        ));

       /* //wczytanie modelu zawierjącego funkcje
        //do obsługi tabeli 'words'
        $model = new DeliveyInfo('search');

        //definicja tablicy, którą będziemy
        //zwracać w odpowiedzi na zapytanie
        $response = array(
            'status' => 'ok',
            'message' => array(),
        );

        //pobranie słowa przesłanego POST'em
        $word = $this->input->post('word',true);

        //walidacja
        if (empty($word)) {
            $response['status'] = 'errors';
            $response['message']['empty'] = 'Uzupełnij słowo';
        }

        if (strlen($word) > 255) {
            $response['status'] = 'errors';
            $response['message']['too_long'] = 'Słowo jest za długie';
        }

        //sprawdzenie czy słowo istnieje w bazie danych
        if ($this->words->check($word)) {
            $response['status'] = 'errors';
            $response['message']['word_exist'] = 'Słowo znajduje się już w bazie danych';
        }

        //jeżeli do tej pory nie wystąpiły błędy
        //to możemy zapisać słowo w bazie danych
        if ($response['status']=='ok') {

            //dodajemy słowo do bazy i otrzymujemy
            //id jakie zostało mu nadane
            $id = $this->words->add($word);

            if ($id > 0) {
                //ID jest liczbą naturalną większą od 0
                //co oznacza, że wszystko poszło dobrze
                $response['message']['ok'] = 'Słowo zostało zapisane w bazie danych i otrzymało ID '.$id;
            } else {
                //w przypadku niepowodzenia funkcja add
                //może zwrocić wartość false
                //np. gdy nie uda się połączyć z bazą danych
                $response['status'] = 'errors';
                $response['message']['database'] = 'Wystąpił błąd bazy danych - nie udało się dodać słowa';
            }

        }

        //w odpowiedzi zwracamy obiekt typu JSON
        //i kończymy działanie skryptu
        die(json_encode($response));*/
    }
}
