<?php

/**
 * Class SystemuserController 系统用户
 */
class SystemuserController extends Controller
{

    public function filters()
    {
        return array('rights');
    }

    /**
     * 默认列表
     */
    public function actionIndex()
    {
        $model = new SystemUser('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SystemUser'])) {
            $model->attributes = $_GET['SystemUser'];
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * 添加用户
     */
    public function actionCreate()
    {
        $model = new SystemUser;

        $this->performAjaxValidation($model);

        if (isset($_POST['SystemUser'])) {
            $model->attributes = $_POST['SystemUser'];
            $model->password = md5($model->password);
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * 修改用户
     */
    public function actionUpdate($id)
    {
        if ($id <> 1) {
            $model = $this->loadModel($id);
            $this->performAjaxValidation($model);
            if (isset($_POST['SystemUser'])) {
                //@todo 如果新密码和旧密码不一致则判断修改过
                $oldPassword = $model->password;
                $model->attributes = $_POST['SystemUser'];
                if ($model->password != $oldPassword) {
                    $model->password = md5($oldPassword);
                }
                if(isset($model->modifeTime)){
                    unset($model->modifeTime);
                }
                if ($model->save())
                    $this->redirect(array('index'));
            }

            $this->render('update', array(
                'model' => $model,
            ));
        } else {
            $this->redirect(array('index'));
        }
    }

    /**
     * 删除用户
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            if ($id <> 1) {
                $model = $this->loadModel($id);
                $model->updateByPk($id, array('isDel' => 'Y'));
            }
        } else {
            $this->redirect(array('index'));
        }
    }

    /**
     * Performs the AJAX validation.
     * @param Feedback $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'systemuser-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Feedback the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = SystemUser::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
