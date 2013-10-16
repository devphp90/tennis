<?php

/**
 * This is the model class for table "users_session".
 *
 * The followings are the available columns in table 'users_session':
 * @property integer $id
 * @property string $user_id
 * @property string $name
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class UsersSession extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsersSession the static model class
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
		return 'users_session';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, date', 'required'),
            array('level, ranking, target_level, target_ranking, problem, subjective, objective, plan, score, assessment', 'safe'),
            array('mechanics, timing, footwork, fitness, effectiveness, strategy', 'safe'),
            array('serves_number_of, forehands_number_of, backhands_number_of', 'safe'),
            array('serves_number_of, forehands_number_of, backhands_number_of, serve_mph, forehand_mph, backhand_mph, forehand_longest_rally, backhand_longest_rally, strokes_longest_rally, footwork_speed_sidetoside, footwork_speed_forward, footwork_speed_backward', 'numerical', 'integerOnly' => true),
            array('aces, double_faults, winners, unforced_errors', 'numerical', 'integerOnly' => true),
            array('game_on_off, serve_on_off, return_on_off', 'numerical', 'integerOnly' => true),
            array('game_on_off, serve_on_off, return_on_off', 'length', 'max'=>1),
			array('user_id', 'length', 'max'=>20),
			array('name', 'length', 'max'=>255),
            array('serve_mph, forehand_mph, backhand_mph', 'length', 'max' => '3'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, date', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'name' => 'Name',
			'date' => 'Date',
            'game_on_off' => 'Game',
            'serve_on_off' => 'Serve',
            'return_on_off' => 'Return',
            'serves_number_of' => 'Serves, # in out of 10',
            'forehands_number_of' => 'Forehands, # in out of 10',
            'backhands_number_of' => 'Backhands, # in out of 10'
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
		$criteria->compare('id',$this->id);
        if ( ! Yii::app()->user->checkAccess('users_admin') && Yii::app()->user->type != "reviewer") {
            $criteria->compare('user_id',  Yii::app()->user->id,true);
        }

		$criteria->compare('name',$this->name,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}