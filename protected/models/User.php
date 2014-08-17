<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $firt_name
 * @property string $last_name
 * @property integer $isActivated
 * @property integer $isAdministrator
 */
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, email', 'required'),
            array('username, email', 'unique'),
            array('isActivated, isAdministrator', 'numerical', 'integerOnly' => true),
            array('username, password, firt_name, last_name', 'length', 'max' => 128),
            array('email', 'length', 'max' => 512),
            array('email', 'email'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, email, firt_name, last_name, isActivated, isAdministrator', 'safe', 'on' => 'search'),
        );
    }

   

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Nom d\'utilisateur',
            'password' => 'Mot de pass',
            'email' => 'Email',
            'firt_name' => 'Nom',
            'last_name' => 'Prénom',
            'isActivated' => 'Activé',
            'isAdministrator' => 'Administrateur',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('firt_name', $this->firt_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('isActivated', $this->isActivated);
        $criteria->compare('isAdministrator', $this->isAdministrator);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

     public function behaviors() {
        return array(
            // Classname => path to Class
            'ActiveRecordLogableBehaviorU' =>
            'application.behaviors.ActiveRecordLogableBehaviorU',
        );
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function hash($value) {
        return crypt($value);
    }

    /*protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->password = $this->crypt($this->password);
            }
            return true;
        }
        return false;
    }*/

    public function check($value) {
        $new_hash = crypt($value, $this->password);
        if ($new_hash == $this->password) {
            return true;
        }
        return false;
    }

    public function getAdministratorsUsernamesList() {
        $user = User::model()
                ->findAllByAttributes(array(
            'isAdministrator' => 1,
        ));
        $result = array();
        foreach ($user as $key => $value) {
            $result[$key] = $value->username;
        }
        return $result;
    }

}
