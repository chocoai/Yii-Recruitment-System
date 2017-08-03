<?php

/**
 * Class FeedbackController 面试反馈
 */
class FeedbackController extends Controller
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
     * 添加数据
     */
    public function actionCreate()
    {
        $model = new Feedback;
        $model->recruiter = Yii::app()->user->name;
        $this->performAjaxValidation($model);

        if (isset($_POST['Feedback'])) {
            $model->attributes = $_POST['Feedback'];

            //如果有简历上传
            $resume = "";
            if (!empty($_FILES['file']['tmp_name'])) {
                $file = CUploadedFile::getInstanceByName('file');

                $dir = Yii::getPathOfAlias('webroot') . '/upload/resume';//上传目录
                if (!is_dir($dir)) {
                    mkdir($dir);
                }
                $prefix = time();
                $name = $dir . '/' . $prefix . '-' . $file->name; //文件名绝对路径
                $status = $file->saveAs($name, true); //保存文件
                if ($status) {
                    $resume = $prefix . '-' . $file->name;
                }
            }
            $model->resume = !empty($resume) ? $resume : $model->resume;

            unset($model->modifeTime);
            if ($model->save())
                //记录日志
                $this->updateLog(null, json_encode($model->attributes, JSON_UNESCAPED_UNICODE), Yii::app()->user->name, '新增数据');
            $this->redirect(array('index'));
        }

        $this->render('create', array(
            'model' => $model,
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

            //如果有简历上传
            $resume = "";
            if (!empty($_FILES['file']['tmp_name'])) {
                $file = CUploadedFile::getInstanceByName('file');

                $dir = Yii::getPathOfAlias('webroot') . '/upload/resume';//上传目录
                if (!is_dir($dir)) {
                    mkdir($dir);
                }
                $prefix = time();
                $name = $dir . '/' . $prefix . '-' . $file->name; //文件名绝对路径
                $status = $file->saveAs($name, true); //保存文件
                if ($status) {
                    $resume = $prefix . '-' . $file->name;
                }
            }

            //记录日志
            $this->updateLog(json_encode($model->attributes, JSON_UNESCAPED_UNICODE), json_encode($_POST['Feedback'], JSON_UNESCAPED_UNICODE), Yii::app()->user->name, '修改面试反馈');
            $model->attributes = $_POST['Feedback'];
            $model->resume = !empty($resume) ? $resume : $model->resume;
            if (isset($model->modifeTime)) {
                unset($model->modifeTime);
            }
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
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
            $this->updateLog(null, $id, Yii::app()->user->name, '删除用户');
            $model->updateByPk($id, array('isDel' => 'Y'));
        }
    }

    /**
     * 确认参加面试
     * @param $id 表主健ID
     */
    public function actionVia($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            //记录日志
            $this->updateLog(null, $id, Yii::app()->user->name, '确认参加面试');
            $isInterview = ($model->isInterview == '是') ? '否' : '是';
            $model->updateByPk($id, array('isInterview' => $isInterview));
        }
    }

    /**
     * 简历预览
     * @param $id 表主健ID
     */
    public function actionPreview($id)
    {
        $model = $this->loadModel($id);
        if (!empty($model->resume)) {
            $extension = pathinfo($model->resume, PATHINFO_EXTENSION);
            $name = pathinfo($model->resume, PATHINFO_FILENAME);
            
	    //如果不是pdf文件,转换生成PDF文件
            if (strtolower($extension) != 'pdf') {
                //$command = "sudo /usr/bin/unoconv --server localhost --port 8100 -f pdf " . Yii::getPathOfAlias('webroot') . '/upload/resume/' . str_ireplace(' ', '\\ ', $model->resume);
   		$command = "sudo /usr/bin/unoconv -f pdf " . Yii::getPathOfAlias('webroot') . '/upload/resume/' . str_ireplace(' ', '\\ ', $model->resume);
  		$status = exec($command);
                if ($status == 0) {
                    $model->updateByPk($id, array('resume' => $name . ".pdf"));
                }
            }
            $path = Yii::getPathOfAlias('webroot') . '/upload/resume/' . $name . ".pdf";
	    
            if(file_exists($path)){
            	header('Content-type: application/pdf');
            	readfile($path);
            }else{
		header('Content-type: text/html;charset=UTF-8');
		echo "此文件无法预览,请下载后查看";		
	    }
	}
  }

    /**
     * 导入数据
     */
    public function actionImport()
    {
        if (!empty($_FILES['file']['tmp_name'])) {
            $file = CUploadedFile::getInstanceByName('file');

            if (is_null($file)) {
                echo '请选择上传文件';
                return;
            }

            $dir = Yii::getPathOfAlias('webroot') . '/upload/' . date("Y-m-d");//上传目录
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $name = $dir . '/' . $file->name; //文件名绝对路径
            $status = $file->saveAs($name, true); //保存文件
            header('Content-Type: text/html; charset=utf-8');
            if ($status) {

                $PHPExcel = new PHPExcel();
                $reader = PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
                $objPHPExcel = $reader->load($name); // 载入excel文件
                $sheet = $objPHPExcel->getSheet(0); // 读取第一個工作表
                $allRow = $sheet->getHighestRow(); // 取得总行数
                $success = 0;
                $error = '';
		for ($row = 2; $row <= $allRow; $row++) {

                    $model = new Feedback();
                    $model->recruiter = $sheet->getCell('B' . $row)->getValue();
		    $model->invitation = Helper::excelTime($sheet->getCell('C' . $row)->getFormattedValue());
		    $model->name = trim($sheet->getCell('D' . $row)->getValue());
                    $model->phone = trim($sheet->getCell('E' . $row)->getValue());
                    $model->email = trim($sheet->getCell('F' . $row)->getValue());
                    $model->graduateInstitutions = $sheet->getCell('G' . $row)->getValue();
                    $model->education = $sheet->getCell('H' . $row)->getValue();
                    $model->major = $sheet->getCell('I' . $row)->getValue();
                    $model->graduationTime = $sheet->getCell('J' . $row)->getValue();
                    $model->experience = $sheet->getCell('K' . $row)->getValue();
                    $model->famousExperience = $sheet->getCell('L' . $row)->getValue();
                    $model->channel = $sheet->getCell('M' . $row)->getValue();
                    $model->jobCandidates = $sheet->getCell('N' . $row)->getValue();
                    $model->solicitationRecord = $sheet->getCell('O' . $row)->getValue();
                    $model->interviewDate = Helper::excelTime($sheet->getCell('P' . $row)->getFormattedValue());
                    $model->interviewTime = $sheet->getCell('Q' . $row)->getFormattedValue();
                    $model->isInterview = $sheet->getCell('R' . $row)->getValue();
                    $model->interviewer = $sheet->getCell('S' . $row)->getValue();
                    $model->skill = $sheet->getCell('T' . $row)->getValue();
                    $model->interviewEvaluation = $sheet->getCell('U' . $row)->getValue();
                    $model->interviewResults = $sheet->getCell('V' . $row)->getValue();
                    $model->entryDate = Helper::excelTime($sheet->getCell('W' . $row)->getFormattedValue());
                    $model->isEntry = $sheet->getCell('X' . $row)->getValue();
                    $model->confirmationDate = Helper::excelTime($sheet->getCell('Y' . $row)->getFormattedValue());
                    $model->isConfirmation = $sheet->getCell('Z' . $row)->getValue();
                    $model->departureDate = Helper::excelTime($sheet->getCell('AA' . $row)->getValue());
                    $model->beforeSalary = $sheet->getCell('AB' . $row)->getValue();
                    $model->salary = $sheet->getCell('AC' . $row)->getValue();
                    $model->remark = $sheet->getCell('AD' . $row)->getValue();

                    if ($model->validate() && $model->save()) {
                        $success++;
                    } else {
                        $error .= 'Excel行号:' . $row . '  姓名:' . $model->name . '  错误信息:' . json_encode($model->getErrors(), JSON_UNESCAPED_UNICODE) . "<br>";
                    }
                }

                echo "成功条数:" . $success . '<br>失败信息<br>' . $error;
            } else {
                echo '上传失败';
                die;
            }
        } else {
            $this->redirect($this->createUrl('index'));
        }
    }

    /**
     * Suggests tags based on the current user input.
     * This is called via AJAX when the user is entering the tags input.
     */
    public function actionSuggestChannel()
    {
        if (Yii::app()->request->isAjaxRequest) {
            if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
                $channels = Feedback::model()->suggestChannel($keyword);
                if ($channels !== array())
                    echo implode("\n", $channels);
            }
        } else {
            $this->redirect($this->createUrl('index'));
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
        $dataProvider = $model->search();
        $dataProvider->setPagination(false); //禁用分页
        $data = $dataProvider->getData();

        $phpexcel = new PHPExcel();

        $phpexcel->getDefaultStyle()->getFont()->setName('Microsoft YaHei');
        $phpexcel->getDefaultStyle()->getFont()->setSize(10);
        $phpexcel->getActiveSheet()->getStyle('A1:AD1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $phpexcel->getActiveSheet()->getStyle('A1:AD1')->getFill()->getStartColor()->setARGB('#666666');
        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

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
            $phpexcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);

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

            $phpexcel->getActiveSheet()->getStyle("A$i:AD$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        }

        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="电话邀约及面试反馈.xls"');
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
        $model = Feedback::model()->findByPk(intval($id));
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
