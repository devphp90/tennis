<?php

/**
 * This is the model class for table "users_guiders_flag".
 *
 * The followings are the available columns in table 'users_guiders_flag':
 * @property string $id
 * @property string $guiders_page_id
 * @property string $user_id
 * @property integer $flag
 *
 * The followings are the available model relations:
 * @property GuidersPage $guidersPage
 * @property Users $user
 */
class UsersGuidersFlag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsersGuidersFlag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_guiders_flag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('guiders_page_id, user_id, flag', 'required'),
			array('flag', 'numerical', 'integerOnly'=>true),
			array('guiders_page_id', 'length', 'max'=>10),
			array('user_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, guiders_page_id, user_id, flag', 'safe', 'on'=>'search'),
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
			'guidersPage' => array(self::BELONGS_TO, 'GuidersPage', 'guiders_page_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'guiders_page_id' => 'Guiders Page',
			'user_id' => 'User',
			'flag' => 'Flag',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('guiders_page_id',$this->guiders_page_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('flag',$this->flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}