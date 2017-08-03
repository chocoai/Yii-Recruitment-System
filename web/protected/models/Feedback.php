<?php

/**
 * This is the model class for table "{{feedback}}".
 *
 * The followings are the available columns in table '{{feedback}}':
 * @property integer $id
 * @property string $recruiter
 * @property string $invitation
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $graduateInstitutions
 * @property string $education
 * @property string $major
 * @property string $graduationTime
 * @property string $experience
 * @property string $famousExperience
 * @property string $channel
 * @property string $jobCandidates
 * @property string $product
 * @property string $solicitationRecord
 * @property string $interviewDate
 * @property string $interviewTime
 * @property string $isInterview
 * @property string $interviewer
 * @property string $skill
 * @property string $interviewEvaluation
 * @property string $interviewResults
 * @property string $remark
 * @property string $isAccept
 * @property string $entryDate
 * @property string $isEntry
 * @property string $confirmationDate
 * @property string $isConfirmation
 * @property string $departureDate
 * @property string $beforeSalary
 * @property string $salary
 * @property string $modifeTime
 * @property string $isDel
 * @property string $resume
 */
class Feedback extends CActiveRecord
{

    public $_education = ['211/985硕士' => '211/985硕士', '普通硕士' => '普通硕士', '211/985本科' => '211/985本科', '普通本科' => '普通本科', '大专' => '大专', '专升本' => '专升本', '其他' => '其他'];

    public $_if = ['是' => '是', '否' => '否'];

    public $_interviewResults = ['通过' => '通过', '未通过' => '未通过', '待定' => '待定'];

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{feedback}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('recruiter, invitation, name', 'required'),
            array('phone', 'unique'),
            array('phone', 'match', 'pattern' => '/^1[0-9]{10}$/', 'message' => '{attribute}必须为1开头的11位纯数字'),
            array('interviewDate,entryDate,confirmationDate,departureDate,interviewTime', 'default', 'value' => null),
            array('recruiter', 'length', 'max' => 30),
            array('name, phone, major', 'length', 'max' => 20),
            array('email', 'length', 'max' => 50),
            array('email', 'email'),
            array('graduateInstitutions, education, graduationTime, jobCandidates, product, interviewTime, isInterview, interviewResults', 'length', 'max' => 100),
            array('experience, famousExperience, channel, interviewer, skill, resume', 'length', 'max' => 200),
            array('isAccept', 'length', 'max' => 255),
            array('isEntry, isConfirmation, beforeSalary, salary', 'length', 'max' => 10),
            array('interviewDate, remark, entryDate, confirmationDate, departureDate, solicitationRecord,interviewEvaluation,modifeTime, isDel', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, recruiter, invitation, name, phone, email, graduateInstitutions, education, major, graduationTime, experience, famousExperience, channel, jobCandidates, product, solicitationRecord, interviewDate, interviewTime, isInterview, interviewer, skill, interviewEvaluation, interviewResults, remark, isAccept, entryDate, isEntry, confirmationDate, isConfirmation, departureDate, beforeSalary, salary', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'recruiter' => 'Recruiter',
            'invitation' => '邀约日期',
            'name' => '姓名',
            'phone' => '手机',
            'email' => '邮箱',
            'graduateInstitutions' => '毕业院校',
            'education' => '学历',
            'major' => '专业',
            'graduationTime' => '毕业时间',
            'experience' => '相关工作经验',
            'famousExperience' => '名企经验',
            'channel' => '渠道',
            'jobCandidates' => '应聘岗位',
            'product' => '产品线',
            'solicitationRecord' => '邀约记录',
            'interviewDate' => '面试日期',
            'interviewTime' => '面试时间',
            'isInterview' => '是否参加面试',
            'interviewer' => '面试官',
            'skill' => '技能点',
            'interviewEvaluation' => '面试评价',
            'interviewResults' => '面试结果',
            'remark' => '备注',
            'isAccept' => '是否接受Offer',
            'entryDate' => '入职日期',
            'isEntry' => '是否入职',
            'confirmationDate' => '转正日期',
            'isConfirmation' => '是否转正',
            'departureDate' => '离职日期',
            'beforeSalary' => '上一家薪资',
            'salary' => '期望薪资',
            'modifeTime' => '更新时间',
            'isDel' => '是否删除',
            'resume' => '简历附件'
        );
    }

    protected function beforeFind()
    {
        parent::beforeFind();
        $this->beforeSearch();
    }

    protected function beforeCount()
    {
        parent::beforeCount();
        $this->beforeSearch();
    }

    protected function beforeSearch()
    {
        $criteria = $this->getDbCriteria();
        if (!empty($this->invitation)) {
            $invitation = explode('-', $this->invitation);
            $criteria->addBetweenCondition('invitation', (str_replace('.', '-', $invitation[0])), (str_replace('.', '-', $invitation[1])));
        }
        if (!empty($this->interviewDate)) {
            $interviewDate = explode('-', $this->interviewDate);
            $criteria->addBetweenCondition('interviewDate', (str_replace('.', '-', $interviewDate[0])), (str_replace('.', '-', $interviewDate[1])));
        }
        if (!empty($this->entryDate)) {
            $entryDate = explode('-', $this->entryDate);
            $criteria->addBetweenCondition('entryDate', (str_replace('.', '-', $entryDate[0])), (str_replace('.', '-', $entryDate[1])));
        }
        if (!empty($this->departureDate)) {
            $departureDate = explode('-', $this->departureDate);
            $criteria->addBetweenCondition('departureDate', (str_replace('.', '-', $departureDate[0])), (str_replace('.', '-', $departureDate[1])));
        }

        if (strpos($this->channel, ' ')) {
            $titles = explode(' ', $this->channel);
            foreach ($titles as $k => $v) {
                $criteria->addSearchCondition('channel', $v, true, 'OR');
            }
        } else {
            $criteria->compare('channel', $this->channel, true);
        }
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('recruiter', $this->recruiter, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('graduateInstitutions', $this->graduateInstitutions, true);
        $criteria->compare('education', $this->education, true);
        $criteria->compare('graduationTime', $this->graduationTime, true);
        $criteria->compare('experience', $this->experience, true);
        $criteria->compare('famousExperience', $this->famousExperience, true);
        $criteria->compare('jobCandidates', $this->jobCandidates, true);
        $criteria->compare('product', $this->product, true);
        $criteria->compare('solicitationRecord', $this->solicitationRecord, true);
        $criteria->compare('interviewTime', $this->interviewTime, true);
        $criteria->compare('isInterview', $this->isInterview, true);
        $criteria->compare('interviewer', $this->interviewer, true);
        $criteria->compare('skill', $this->skill, true);
        $criteria->compare('interviewEvaluation', $this->interviewEvaluation, true);
        $criteria->compare('interviewResults', $this->interviewResults);
        $criteria->compare('isAccept', $this->isAccept, true);
        $criteria->compare('isEntry', $this->isEntry, true);
        $criteria->compare('isConfirmation', $this->isConfirmation, true);
        $criteria->compare('beforeSalary', $this->beforeSalary, true);
        $criteria->compare('salary', $this->salary, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('modifeTime',$this->modifeTime,true);
        $criteria->compare('isDel','N');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'id desc',
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['pagination']['pageSize'],
                'pageVar' => Yii::app()->params['pagination']['pageVar'],
            ),
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function offerSearch()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('recruiter', $this->recruiter, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('graduateInstitutions', $this->graduateInstitutions, true);
        $criteria->compare('education', $this->education, true);
        $criteria->compare('graduationTime', $this->graduationTime, true);
        $criteria->compare('experience', $this->experience, true);
        $criteria->compare('famousExperience', $this->famousExperience, true);
        $criteria->compare('jobCandidates', $this->jobCandidates, true);
        $criteria->compare('product', $this->product, true);
        $criteria->compare('solicitationRecord', $this->solicitationRecord, true);
        $criteria->compare('interviewTime', $this->interviewTime, true);
        $criteria->compare('isInterview', $this->isInterview, true);
        $criteria->compare('interviewer', $this->interviewer, true);
        $criteria->compare('skill', $this->skill, true);
        $criteria->compare('interviewEvaluation', $this->interviewEvaluation, true);
        $criteria->compare('interviewResults', '通过');
        $criteria->compare('isAccept', $this->isAccept, true);
        $criteria->compare('isEntry', $this->isEntry, true);
        $criteria->compare('isConfirmation', $this->isConfirmation, true);
        $criteria->compare('beforeSalary', $this->beforeSalary, true);
        $criteria->compare('salary', $this->salary, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('modifeTime',$this->modifeTime,true);
        $criteria->compare('isDel','N');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'interviewDate desc',
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['pagination']['pageSize'],
                'pageVar' => Yii::app()->params['pagination']['pageVar'],
            ),
        ));
    }

    public function suggestChannel($keyword, $limit = 20)
    {
        $channels = $this->findAll(array(
            'condition' => 'channel LIKE :keyword',
            'order' => 'id DESC',
            'group' => 'channel',
            'limit' => $limit,
            'params' => array(
                ':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
            ),
        ));
        $names = array();
        foreach ($channels as $channel)
            $names[] = $channel->channel;
        return $names;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Feedback the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
