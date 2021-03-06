<?php

/**
 * UsersData class file.
 * Model class file for table users_data.
 *
 * @copyright	Copyright &copy; 2012 Hardalau Claudiu 
 * @package		bum
 * @license		New BSD License 
 */
/**
 * UsersData  class.
 * @package		bum
 */

/**
 * This is the model class for table "users_data".
 *
 * The followings are the available columns in table 'users_data':
 * @property string $id
 * @property string $description
 * @property string $site
 * @property string $goals
 * @property string $facebook_address
 * @property string $twitter_address
 * @property string $activation_code
 * @property string $date_of_update
 *
 * The followings are the available model relations:
 * @property Users $id0
 */
class UsersData extends BumActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UsersData the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users_data';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('date_of_update', 'date'), // out, because date_of_update is generated by postgresql from a trigger
            array('invitations_left', 'type', 'type' => 'integer'),
            array('id', 'required'),
            array('site', 'length', 'max' => 1500),
            array('facebook_address, twitter_address', 'length', 'max' => 60),
            array('goals', 'length', 'max' => 100),
            array('description, obs, goals', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                // array('id, description, site, facebook_address, twitter_address', 'safe', 'on'=>'search'), // actually for now there is no search facility for this model
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'users' => array(self::BELONGS_TO, 'Users', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'description' => 'Description',
            'site' => 'Site',
            'facebook_address' => 'Facebook Address',
            'twitter_address' => 'Twitter Address',
            'activation_code' => 'Activation Code',
            'date_of_update' => 'Date Of Update (users_data)',
            'obs' => 'Observations',
            'goals' => 'Goals',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    /* public function search()
      {
      // Warning: Please modify the following code to remove attributes that
      // should not be searched.

      $criteria=new CDbCriteria;

      $criteria->compare('id',$this->id,true);
      $criteria->compare('description',$this->description,true);
      $criteria->compare('site',$this->site,true);
      $criteria->compare('facebook_address',$this->facebook_address,true);
      $criteria->compare('twitter_address',$this->twitter_address,true);

      return new CActiveDataProvider($this, array(
      'criteria'=>$criteria,
      ));
      } */

    /**
     * Update some datatime statistical fields.
     */
    public function beforeSave() {
        if (!Yii::app()->getModule('bum')->db_triggers) {
            $this->date_of_update = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }

}