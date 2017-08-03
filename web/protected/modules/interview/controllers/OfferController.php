<?php

/**
 * Class OfferController Offer及入职
 */
class OfferController extends Controller
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
        $model = new Feedback('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Feedback'])) {
            $model->attributes = $_GET['Feedback'];
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * 展示数据详情
     * @param $id 表主键ID
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * 修改数据
     * @param $id 表主键ID
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $this->performAjaxValidation($model);
        if (isset($_POST['Feedback'])) {
            //记录日志
            $this->updateLog(json_encode($model->attributes, JSON_UNESCAPED_UNICODE), json_encode($_POST['Feedback'], JSON_UNESCAPED_UNICODE), Yii::app()->user->name, '修改面试反馈');

            $model->attributes = $_POST['Feedback'];
            unset($model->modifeTime);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * 删除数据
     * @param $id 表主键ID
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            //记录日志
            $this->updateLog(null, $id, Yii::app()->user->name, '删除记录');
            $model->updateByPk($id, array('isDel' => 'Y'));
        }
    }

    /**
     * 是否入职
     * @param $id 表主键ID
     */
    public function actionEntry($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            //记录日志
            $this->updateLog(null, $id, Yii::app()->user->name, '确认入职');
            $isEntry = ($model->isEntry == '是') ? '否' : '是';
            $model->updateByPk($id, array('isEntry' => $isEntry));
        }
    }

    /**
     * 导出数据
     */
    public function actionExport()
    {
        //获取数据
        $model = new Feedback;
        $model->unsetAttributes();
        if (isset($_GET['Feedback'])) {
            $model->attributes = $_GET['Feedback'];
        }
        $dataProvider = $model->offerSearch();
        $dataProvider->setPagination(false); //禁用分页
        $data = $dataProvider->getData();

        $phpexcel = new PHPExcel();
        $phpexcel->getDefaultStyle()->getFont()->setName( 'Microsoft YaHei');
        $phpexcel->getDefaultStyle()->getFont()->setSize(10);
        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $model->getAttributeLabel('id'))
            ->setCellValue('B1', $model->getAttributeLabel('recruiter'))
            ->setCellValue('C1', $model->getAttributeLabel('invitation'))
            ->setCellValue('D1', $model->getAttributeLabel('name'))
            ->setCellValue('E1', $model->getAttributeLabel('phone'))
            ->setCellValue('F1', $model->getAttributeLabel('email'))
            ->setCellValue('G1', $model->getAttributeLabel('graduateInstitutions'))
            ->setCellValue('H1', $model->getAttributeLabel('education'))
            ->setCellValue('I1', $model->getAttributeLabel('major'))
            ->setCellValue('J1', $model->getAttributeLabel('graduationTime'))
            ->setCellValue('K1', $model->getAttributeLabel('experience'))
            ->setCellValue('L1', $model->getAttributeLabel('famousExperience'))
            ->setCellValue('M1', $model->getAttributeLabel('channel'))
            ->setCellValue('N1', $model->getAttributeLabel('jobCandidates'))
            ->setCellValue('O1', $model->getAttributeLabel('solicitationRecord'))
            ->setCellValue('P1', $model->getAttributeLabel('interviewDate'))
            ->setCellValue('Q1', $model->getAttributeLabel('interviewTime'))
            ->setCellValue('R1', $model->getAttributeLabel('isInterview'))
            ->setCellValue('S1', $model->getAttributeLabel('interviewer'))
            ->setCellValue('T1', $model->getAttributeLabel('skill'))
            ->setCellValue('U1', $model->getAttributeLabel('interviewEvaluation'))
            ->setCellValue('V1', $model->getAttributeLabel('interviewResults'))
            ->setCellValue('W1', $model->getAttributeLabel('entryDate'))
            ->setCellValue('X1', $model->getAttributeLabel('isEntry'))
            ->setCellValue('Y1', $model->getAttributeLabel('confirmationDate'))
            ->setCellValue('Z1', $model->getAttributeLabel('isConfirmation'))
            ->setCellValue('AA1', $model->getAttributeLabel('departureDate'))
            ->setCellValue('AB1', $model->getAttributeLabel('beforeSalary'))
            ->setCellValue('AC1', $model->getAttributeLabel('salary'))
            ->setCellValue('AD1', $model->getAttributeLabel('remark'));

        $i = 2;
        foreach ($data as $key => $val) {

            $phpexcel->getActiveSheet()->getStyle("E$i")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);

            $phpexcel->setActiveSheetIndex(0)
                ->setCellValue("A$i", $val['id'])
                ->setCellValue("B$i", $val['recruiter'])
                ->setCellValue("C$i", $val['invitation'])
                ->setCellValue("D$i", $val['name'])
                ->setCellValue("E$i", $val['phone'])
                ->setCellValue("F$i", $val['email'])
                ->setCellValue("G$i", $val['graduateInstitutions'])
                ->setCellValue("H$i", $val['education'])
                ->setCellValue("I$i", $val['major'])
                ->setCellValue("J$i", $val['graduationTime'])
                ->setCellValue("K$i", $val['experience'])
                ->setCellValue("L$i", $val['famousExperience'])
                ->setCellValue("M$i", $val['channel'])
                ->setCellValue("N$i", $val['jobCandidates'])
                ->setCellValue("O$i", $val['solicitationRecord'])
                ->setCellValue("P$i", $val['interviewDate'])
                ->setCellValue("Q$i", $val['interviewTime'])
                ->setCellValue("R$i", $val['isInterview'])
                ->setCellValue("S$i", $val['interviewer'])
                ->setCellValue("T$i", $val['skill'])
                ->setCellValue("U$i", $val['interviewEvaluation'])
                ->setCellValue("V$i", $val['interviewResults'])
                ->setCellValue("W$i", $val['entryDate'])
                ->setCellValue("X$i", $val['isEntry'])
                ->setCellValue("Y$i", $val['confirmationDate'])
                ->setCellValue("Z$i", $val['isConfirmation'])
                ->setCellValue("AA$i", $val['departureDate'])
                ->setCellValue("AB$i", $val['beforeSalary'])
                ->setCellValue("AC$i", $val['salary'])
                ->setCellValue("AD$i", $val['remark']);
            $i++;
        }
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="offer及入职.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * Performs the AJAX validation.
     * @param Feedback $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'feedback-form') {
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
    protected function loadModel($id)
    {
        $model = Feedback::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * 记录数据修改日志记录
     * @param string $afterDate 修改前数据
     * @param string $beforeDate 修改后数据
     * @param string $userName 修改用户
     * @param string $remark 备注
     * @return bool
     */
    protected function updateLog($beforeDate = '', $afterDate = '', $userName = '', $remark = '')
    {
        $logModel = new UpdateLog();
        $logModel->afterDate = $afterDate;
        $logModel->beforeDate = $beforeDate;
        $logModel->userName = $userName;
        $logModel->remark = $remark;
        return $logModel->save();
    }
}