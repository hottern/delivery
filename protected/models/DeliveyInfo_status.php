<?php

/**
 * This is the model class for table "delivey_info".
 *
 * The followings are the available columns in table 'delivey_info':
 * @property integer $id
 * @property string $fio
 * @property string $date
 * @property integer $status_id
 * @property integer $weight
 * @property string $code
 */
class DeliveyInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'delivey_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fio, date, status_id, weight', 'required'),
			array('weight', 'numerical', 'integerOnly', 'status_id'=>true),
			array('fio', 'length', 'max'=>255),

			array('code', 'length', 'max'=>125),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fio, date, status_id, weight, code', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'Statusinfo' =>array(self::HAS_MANY, 'Statusinfo', 'status_id'),
		);
	}


    protected function afterSave() {
        parent::afterSave();
        if ($this->isNewRecord) {
            $new_id = sprintf('CN492B9%06d', $this->id);
            $this->code = $new_id;
            $this->isNewRecord = false;
            $this->saveAttributes(array('code'));
        }
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fio' => 'Fio',
			'date' => 'Date',
			'status_id' => 'Status_id',
			'weight' => 'Weight',
			'code' => 'Code',
		);
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status_id',$this->status_id,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeliveyInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}
