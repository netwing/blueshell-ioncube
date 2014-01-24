<?php

class OrderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var string the detault page title
	 */
	public $pageTitle = 'order';

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
            array('allow', 'actions' => array('index', 'view', 'admin', 'print'), 'roles' => array('admin:order:read')),
            array('allow', 'actions' => array('create'), 'roles' => array('admin:order:create')),
            array('allow', 'actions' => array('update'), 'roles' => array('admin:order:update')),
            array('allow', 'actions' => array('delete'), 'roles' => array('admin:order:delete')),
            array('allow', 'actions' => array('toInvoice'), 'roles' => array('admin:invoice:create')),
            array('deny', 'users'=>array('*')),
        );

		// Simple access control list
		/*
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
		*/

	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$details = $model->orderDetails;
		foreach ($details as $detail) {
			if ($detail->contract_id) {
				// Copy flash messages
				$flashes = Yii::app()->user->getFlashes();
				foreach ($flashes as $k => $v) {
					Yii::app()->user->setFlash($k, $v);
				}
				$this->redirect("../riepilogo.php?id=" . $detail->contract_id);
			}
		}
		$this->render('view',array(
			'model' => $model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Order;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Order'])) {
			$model->attributes=$_POST['Order'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$model->date = strftime("%Y-%m-%d", time());

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
		$this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
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
		try {
			$this->loadModel($id)->delete();
		} catch (CDbException $e) {
			echo Yii::t('app', "Unable to delete this item, maybe it's connected to something else in application.");
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
		$dataProvider=new CActiveDataProvider('Order');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order'])) {
			$model->attributes=$_GET['Order'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Print order
	 */
	public function actionPrint($id, $output = "D")
	{
		// Load order model
		$model = $this->loadModel($id);

		// Init Smarty
		$smarty = new Smarty();
		Yii::registerAutoloader('smartyAutoload');
		$smarty->setCompileDir(APPLICATION_PATH . "/runtime/templates_c");

		// Load header template
		$template = SystemTemplate::model()->findByPk(array('id' => 'PRINT_HEADER', 'language' => Yii::app()->language));
		// English fallbacl
		if (!$template) {
			$template = SystemTemplate::model()->findByPk(array('id' => 'PRINT_HEADER', 'language' => "en"));
		}
		$header = $smarty->fetch('string:' . $template->html_content);

		// Load footer template
		$template = SystemTemplate::model()->findByPk(array('id' => 'PRINT_FOOTER', 'language' => Yii::app()->language));
		// English fallbacl
		if (!$template) {
			$template = SystemTemplate::model()->findByPk(array('id' => 'PRINT_FOOTER', 'language' => "en"));
		}
		$smarty->assign("footer_date", Yii::app()->format->formatDateLong(time()));
		$footer = $smarty->fetch('string:' . $template->html_content);

		// Load template
		$template = SystemTemplate::model()->findByPk(array('id' => 'PRINT_ORDER', 'language' => Yii::app()->language));
		// English fallbacl
		if (!$template) {
			$template = SystemTemplate::model()->findByPk(array('id' => 'PRINT_ORDER', 'language' => "en"));
		}

		// Assign Smarty variables
		$smarty->assign('header', $header);
		$smarty->assign('footer', $footer);
		$smarty->assign('order', $model);
		$smarty->assign('background_color', $model->status->color);
		$smarty->assign('foreground_color', Color::getContrastYIQ($model->status->color));
		$smarty->assign('order_date', Yii::app()->format->formatDate($model->date));
		$smarty->assign('order_work_date', Yii::app()->format->formatDate($model->work_date));
		$smarty->assign('order_due_date', Yii::app()->format->formatDate($model->due_date));

		// Get smarty output

		$html = $smarty->fetch('string:' . $template->html_content);
		// echo $html; exit;

		// create new PDF document
		$pdf = new MyPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		$pdf->setHtmlHeader($header);
		$pdf->setHtmlFooter($footer);

		// $pdf->SetPrintHeader(false);
		// $pdf->SetPrintFooter(false);
		$pdf->AddPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');	
	
		$pdf->setPage(1);

		$status = $model->status->name;
		$color = Color::getDecimal($model->status->color);
		$text_color = Color::getContrastYIQ($model->status->color, "int");
		$pdf->SetFillColor($color[0], $color[1], $color[2]);
		$pdf->SetDrawColor($color[0]-30, $color[1]-30, $color[2]-30);
		$pdf->SetXY(0,0);
		$pdf->SetFont('freesans','B',28);
		$pdf->SetTextColor($text_color);
		$pdf->SetLineWidth(0.75);
		$pdf->StartTransform();
		$pdf->Rotate(-35, 90, 200);
		$pdf->Cell(110, 18, strtoupper($status),'TB',0,'C','1');
		$pdf->StopTransform();
		$pdf->SetTextColor(0);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetDrawColor(0, 0, 0);


		$filename = "Order" . $model->id . ".pdf";
		
		$pdf->Output($filename, $output);

        // Clean ending
        Yii::app()->end();

	}

	/**
	 * Create an invoice from order
	 * If create is successful, the browser will be redirected to the 'view' page of invoice.
	 * @param integer $id the ID of the model
	 * @param integer $number if not null set a number for created invoice
	 */
	public function actionToInvoice($id, $n = null)
	{
		$model = $this->loadModel($id);

		$invoice = $model->toInvoice((bool) $n);

		if ($invoice->hasErrors() === true) {
			Yii::log("Unable to save invoice", 'error', 'admin.order.toInvoice');
			Yii::log(print_r($invoice->getErrors(), true), 'error', 'admin.order.toInvoice');
			Yii::app()->user->setFlash('danger', Yii::t('app', 'Unable to save invoice, required fields on customer are missing (like address or tax number).'));
			$this->redirect(array('view', 'id' => $model->id));
		}
		$this->redirect(array('/admin/invoice/view','id' => $invoice->id));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Order the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Order::model()->findByPk($id);
		if($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Order $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
