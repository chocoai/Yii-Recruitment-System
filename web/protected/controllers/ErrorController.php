<?php

class ErrorController extends Controller
{
	public $layout= '//layouts/ace/error';

	public function actionIndex()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('index', $error);
		}
	}
}