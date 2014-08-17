<?php

/**
 * This is the model class for table "donneur".
 *
 * The followings are the available columns in table 'donneur':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $age
 * @property string $gender
 * @property string $address
 * @property string $phone
 * @property string $date_donation
 * @property string $email
 * @property string $postal_code
 * @property string $groupe_sangun
 * @property string $vehicle
 */
class Donneur extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'donneur';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, age, gender, address, phone, groupe_sangun', 'required'),
			array('first_name, last_name, email', 'length', 'max'=>255),
			array('age', 'length', 'max'=>2),
			array('gender', 'length', 'max'=>5),
			array('address', 'length', 'max'=>512),
			array('phone, postal_code', 'length', 'max'=>16),
			array('groupe_sangun', 'length', 'max'=>10),
			array('vehicle', 'length', 'max'=>8),
			array('date_donation', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, age, gender, address, phone, date_donation, email, postal_code, groupe_sangun, vehicle', 'safe', 'on'=>'search'),
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
		);
	}

         public function behaviors() {
        return array(
            // Classname => path to Class
            'ActiveRecordLogableBehaviorD' =>
            'application.behaviors.ActiveRecordLogableBehaviorD',
        );
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'age' => 'Age',
			'gender' => 'Gender',
			'address' => 'Address',
			'phone' => 'Phone',
			'date_donation' => 'Date Donation',
			'email' => 'Email',
			'postal_code' => 'Postal Code',
			'groupe_sangun' => 'Groupe Sangun',
			'vehicle' => 'Vehicle',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('date_donation',$this->date_donation,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('postal_code',$this->postal_code,true);
		$criteria->compare('groupe_sangun',$this->groupe_sangun,true);
		$criteria->compare('vehicle',$this->vehicle,true);
                $criteria->addCondition("period_diff(date_format(now(), '%Y%m'), date_format(date_donation, '%Y%m'))>3 OR date_donation is null");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Donneur the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
