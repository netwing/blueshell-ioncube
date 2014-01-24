<?php

class SiteController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

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
        return array(
            array('allow', 'actions' => array('index'), 'roles' => array('admin:main:read')),
            array('allow', 'actions' => array('login', 'logout', 'error', 'contact', 'root')),
            array('allow', 'actions' => array('contact', 'captcha'), 'users'=>array('*')),
            array('deny', 'users' => array('*')),
        );
    }
    
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->redirect("../index.php");
		$this->render('index');
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionRoot()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('root');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if (Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} elseif (defined("APPLICATION_REST")) {
				header("Content-Type: application/json");
				echo CJSON::encode([
                    'success'        => false,
                    'message'        => "Resource not found",
                    'data'           => [
                        "errorCode"  => $error['code'],
                        "message"    => "Resource not found",
                    ]
                ]);
			}
			else {
				$this->render('error', $error);
			}
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$this->layout = "//layouts/column2";
		
		$model = new ContactForm;

		$path = APPLICATION_PATH . "/runtime/temp/uploadSiteContact" . Yii::app()->user->id;

		if (Yii::app()->request->getParam('delete', null) !== null) {
			$file = $path . "/" . Yii::app()->request->getParam('delete', null);
			if (file_exists($file) and is_file($file)) {
				unlink($file);
				$json = array('success' => 'file removed');
				header("Content-type: application/json");
				echo json_encode($json);
				Yii::app()->end();
			}
		}

		if (count($_FILES) > 0) {
			Yii::trace(print_r($_FILES, true));
			if (!file_exists($path)) {
				mkdir($path);
			}
			move_uploaded_file($_FILES['file']['tmp_name'], $path . "/" . $_FILES['file']['name']);
			$json = array('success' => 'file uploaded');
			header("Content-type: application/json");
			echo json_encode($json);
			Yii::app()->end();
		} 

		if (Yii::app()->request->getPost('ContactForm') !== null) {
			$model->attributes = Yii::app()->request->getPost('ContactForm');
			if($model->validate()) {

				$body = '
Tipo di richiesta:Feedback
Progetto:BlueShell

Richiesta:

{request}
';

				$body = str_replace('{request}', $model->body, $body);

				// Mail
				// Create the Transport
				if (EMAIL_SMTP_SERVER) {
					$transport = Swift_SmtpTransport::newInstance(EMAIL_SMTP_SERVER, EMAIL_SMTP_PORT)
					 			 ->setUsername(EMAIL_SMTP_USERNAME)
					  			 ->setPassword(EMAIL_SMTP_PASSWORD);					
				} else {
					$transport = Swift_MailTransport::newInstance();
				}
				// Create the Mailer using your created Transport
				$mailer = Swift_Mailer::newInstance($transport);
				// Create a message
				$message = Swift_Message::newInstance($model->subject)
				  ->setFrom(array($model->email => $model->name))
				  ->setTo(array(Yii::app()->params['podioRequestEmail']))
				  ->setBody($body)
				  ;

				// Attach files
				$files = scandir($path);
				foreach ($files as $file) {
					if ($file != '.' and $file != '..' and is_file($path . "/" . $file)) {
						$message->attach(Swift_Attachment::fromPath($path . "/" . $file));
					}
				}

				// Send the message
				$result = $mailer->send($message);
				if ($result) {
					Yii::log("Email sent to " . Yii::app()->params['podioRequestEmail'], "error", 'system.web.SiteController');
					Yii::app()->user->setFlash('success', Yii::t('app', 'Your request has been successfully sent.'));

					// Delete files
					$files = scandir($path);
					foreach ($files as $file) {
						if ($file != '.' and $file != '..' and is_file($path . "/" . $file)) {
							unlink($path . "/" . $file);
						}
					}


				} else {
					Yii::log("Error in sending email", "error", 'system.web.SiteController');
					Yii::log(print_r($result, true), "warning", 'system.web.SiteController');
					Yii::app()->user->setFlash('danger', Yii::t('app', 'An error occured'));
				}

				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if (Yii::app()->request->getPost('ajax') === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (Yii::app()->request->getPost('LoginForm') !== null)
		{
			$model->attributes = Yii::app()->request->getPost('LoginForm');
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login()) {
				Yii::app()->user->setFlash('success', Yii::t('app', 'Login successful, welcome back.'));
				$this->redirect(Yii::app()->user->returnUrl);
			} else {
				Yii::app()->user->setFlash('danger', Yii::t('app', 'Username not found or invalid password.'));
				$this->redirect(array('login'));
			}				
		}

		if (!Yii::app()->user->isGuest) {
			$this->redirect(array('index'));
		}

		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
