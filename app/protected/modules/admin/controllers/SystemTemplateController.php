<?php

class SystemTemplateController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var string the detault page title
	 */
	public $pageTitle = 'systemTemplate';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		// RBAC access control
        return array(
            array('allow', 'actions' => array('index', 'view', 'admin', 'preview'), 'roles' => array('admin:systemTemplate:read')),
            array('allow', 'actions' => array('create', 'copy'), 'roles' => array('admin:systemTemplate:create')),
            array('allow', 'actions' => array('update'), 'roles' => array('admin:systemTemplate:update')),
            array('allow', 'actions' => array('delete'), 'roles' => array('admin:systemTemplate:delete')),
            array('deny', 'users'=>array('*')),
        );

	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id, $language)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id, $language),
		));
	}

	/**
	 * Displays a particular model as a preview
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPreview($id, $language)
	{
		if ($id == 'PRINT_ORDER') {
			// Load last order
			$order = Order::model()->find(array('order'=>'id DESC'));
			if (!$order) {
				Yii::app()->user->setFlash('warning', 'No order found for show the template.');
				$this->redirect(array('/admin/order/admin'));
			}
			// Redirect user
			$this->redirect(array("/admin/order/print", 'id' => $order->id, 'output' => 'I'));
		} elseif ($id == 'PRINT_INVOICE') {
			// Load last invoice
			$invoice = Invoice::model()->find(array('order'=>'id DESC'));
			if (!$invoice) {
				Yii::app()->user->setFlash('warning', 'No invoice found for show the template.');
				$this->redirect(array('/admin/invoice/admin'));
			}
			// Redirect user
			$this->redirect(array("/admin/invoice/print", 'id' => $invoice->id, 'output' => 'I'));
		} else {
			throw new CHttpException(404,'The requested page does not exist.');
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout = "//layouts/column1";

		$model=new SystemTemplate;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['SystemTemplate'])) {
			$model->attributes=$_POST['SystemTemplate'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('app', "Item has been saved."));
				$this->redirect(array('update', 'id' => $model->id, 'language' => $model->language));
			}
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
	public function actionUpdate($id, $language)
	{
		$this->layout = "//layouts/column1";
		
		$model=$this->loadModel($id, $language);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['SystemTemplate'])) {
			$model->attributes=$_POST['SystemTemplate'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('app', "Item has been saved."));
				$this->redirect(array('update', 'id' => $model->id, 'language' => $model->language));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Copy a model
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionCopy($id, $language)
	{
		$this->layout = "//layouts/column1";

		$model = $this->loadModel($id, $language);
		$model->language = null;
		$model->setIsNewRecord(true);

		/*
		$model = new SystemTemplate();
		$model->id = $original->id;
		$model->text_content = $original->text_content;
		$model->html_content = $original->html_content;
		*/

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['SystemTemplate']))
		{
			$model->attributes=$_POST['SystemTemplate'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('app', "Item has been saved."));
				$this->redirect(array('update', 'id' => $model->id, 'language' => $model->language));
			}
		}

		// List of all allowed languages
		$languages = ELanguagePicker::getSimpleLanguageList();
		// List of languages that already exist for this model
		$exists = CHtml::listData(SystemTemplate::model()->findAllByAttributes(array('id' => $id)), 'language', 'language');
		foreach ($languages as $k => $v) {
			if (array_key_exists($k, $exists)) {
				unset($languages[$k]);
			}
		}
		if (count($languages) <= 0) {
			Yii::app()->user->setFlash('warning', Yii::t('app', "No more languages available for this template, edit one of existings or delete them."));
			$this->redirect(array('admin'));
		}

		$this->render('copy',array(
			'model'=>$model,
			'languages' => $languages,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id, $language)
	{
		$this->loadModel($id, $language)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
		$dataProvider=new CActiveDataProvider('SystemTemplate');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SystemTemplate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SystemTemplate']))
			$model->attributes=$_GET['SystemTemplate'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SystemTemplate the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id, $language)
	{
		$model=SystemTemplate::model()->findByPk(array('id' => $id, 'language' => $language));
		if($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SystemTemplate $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='system-template-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
