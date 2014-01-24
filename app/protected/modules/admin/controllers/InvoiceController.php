<?php

class InvoiceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var string the detault page title
	 */
	public $pageTitle = 'invoice';

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
            array('allow', 'actions' => array('index', 'view', 'admin', 'print'), 'roles' => array('admin:invoice:read')),
            array('allow', 'actions' => array('create'), 'roles' => array('admin:invoice:create')),
            array('allow', 'actions' => array('update', 'split', 'merge', 'status'), 'roles' => array('admin:invoice:update')),
            array('allow', 'actions' => array('delete'), 'roles' => array('admin:invoice:delete')),
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
		$model=new Invoice;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		// Default date
		$model->date = strftime("%Y-%m-%d", time());

		// Default unpaid values for status_id
		$status = InvoiceStatus::model()->findByAttributes(array('unpaid' => 1));
		if ($status) {
			$model->status_id = $status->id;
		}

		// Default types is INCOME
		$type = InvoiceType::model()->findByAttributes(array('type' => "INCOME"));
		if ($type) {
			$model->type_id = $type->id;
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			if($model->save()) {
				Yii::app()->user->setFlash(
					'success', 
					Yii::t('app', 'Invoice updated successfully.')
				);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Set status of a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 * @param integer $id the ID of status
	 */
	public function actionStatus($id, $status)
	{
		$model = $this->loadModel($id);

		if (!isset($status)) {
			$this->redirect(array('view','id'=>$model->id));
		}

		$model->status_id = $status;
		if($model->save()) {
			Yii::app()->user->setFlash(
				'success', 
				Yii::t('app', 'Invoice updated successfully.')
			);
			$this->redirect(array('view','id'=>$model->id));
		}
	}

	/**
	 * Split row from invoice (must be not Paid)
	 * If split is successful, the browser will be redirected to the 'view' page of splitted invoice
	 * @param integer $id the ID of the model to be splitted
	 */
	public function actionSplit($id)
	{
		// Copy invoice
		$original = $this->loadModel($id);
		$attributes = $original->attributes;
		unset($attributes['id']);
		$model = new Invoice();
		$model->attributes = $attributes;
		$model->save();

		// Change invoice_id on each invoice_row
		foreach ($_POST['invoice-row-grid_c0'] as $key => $id) {
			$row = InvoiceRow::model()->findByPk($id);
			$row->invoice_id = $model->id;
			$row->save();
		}
		Yii::app()->user->setFlash('success', Yii::t('app', 'Selected rows has been splitted in new invoice.'));

		$this->redirect(array('view','id'=>$model->id));

	}

	/**
	 * Merge rows from two o more invoice (must be not Paid)
	 */
	public function actionMerge($return = null)
	{
		// Check if all involved invoices have same customer_id
		$first_id = (int) $_POST['invoice_merge'][0];
		$customer_id = $this->loadModel($first_id)->customer_id;
		foreach ($_POST['invoice_merge'] as $key => $id) {
			if ($this->loadModel($id)->customer_id != $customer_id) {
				Yii::app()->user->setFlash('danger', Yii::t('app', 'You can merge only invoices of same customer.'));
				$this->redirect(array('admin'));
			}
		}

		// Do merging
		foreach ($_POST['invoice_merge'] as $key => $id) {
			$invoice = $this->loadModel($id);
			foreach ($invoice->invoiceRows as $row) {
				if ($row->invoice_id == $first_id) {
					continue;
				}
				$row->invoice_id = $first_id;
				$row->save();
			}
		}

		// Do deleting
		foreach ($_POST['invoice_merge'] as $key => $id) {
			if ($id == $first_id) {
				continue;
			}
			$invoice = $this->loadModel($id);
			if (count($invoice->invoiceRows) == 0) {
				$invoice->delete();
			} else {
				Yii::app()->user->setFlash('warning', Yii::t('app', 'Unable to delete invoice #{invoice_id} because still own one or more rows.', array('{invoice_id}' => $invoice->id)));
			}
		}

		Yii::app()->user->setFlash('success', Yii::t('app', 'Selected invoices has been merged together.'));

		if ($return == "/admin/customer/detail") {
			$this->redirect(array("/admin/customer/detail", 'id' => $invoice->customer_id, '#' => 'invoice'));
		}

		$this->redirect(array('admin'));

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
		$this->redirect(array("admin"));
		$dataProvider=new CActiveDataProvider('Invoice');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice'])) {
			$model->attributes=$_GET['Invoice'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Print invoice
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
		$template = SystemTemplate::model()->findByPk(array('id' => 'PRINT_INVOICE', 'language' => Yii::app()->language));
		// English fallbacl
		if (!$template) {
			$template = SystemTemplate::model()->findByPk(array('id' => 'PRINT_INVOICE', 'language' => "en"));
		}

		// Assign Smarty variables
		$smarty->assign('invoice', $model);
		$smarty->assign('background_color', $model->status->color);
		$smarty->assign('foreground_color', Color::getContrastYIQ($model->status->color));
		$smarty->assign('invoice_date', Yii::app()->format->formatDate($model->date));
		$smarty->assign('invoice_due_date', Yii::app()->format->formatDate($model->due_date));
		$smarty->assign('invoice_date_paid', Yii::app()->format->formatDate($model->date_paid));

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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Invoice the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Invoice::model()->findByPk($id);
		if($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Invoice $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
