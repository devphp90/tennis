<?php

/**
 * This is the model class for table "session_photos".
 *
 * The followings are the available columns in table 'session_photos':
 * @property string $id
 * @property string $session_id
 * @property string $file_name
 * @property string $file_type
 * @property integer $file_size
 *
 * The followings are the available model relations:
 * @property UsersSession $session
 */
class SessionPhotos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SessionPhotos the static model class
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
		return 'session_photos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id, file_name, file_type, file_size', 'required'),
			array('file_size', 'numerical', 'integerOnly'=>true),
			array('session_id', 'length', 'max'=>10),
			array('file_name, file_type', 'length', 'max'=>255),
            /*array('file_name', 'file',
                'types'=>'jpg, gif, png',
                'maxSize'=>1024 * 1024 * 2, 'tooLarge'=>'File has to be smaller than 2MB'
            ),*/
            array('file_name', 'EPhotoValidator', 'types'=>'jpg, gif, png', 'allowEmpty' => false, 'maxWidth' => 640, 'maxHeight' => 480),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, session_id, file_name, file_type, file_size', 'safe', 'on'=>'search'),
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
			'session' => array(self::BELONGS_TO, 'UsersSession', 'session_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'session_id' => 'Session',
			'file_name' => 'File Name',
			'file_type' => 'File Type',
			'file_size' => 'File Size',
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
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('file_type',$this->file_type,true);
		$criteria->compare('file_size',$this->file_size);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}