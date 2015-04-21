<?php

/**
 * This is the model class for table "{{_product_service_category}}".
 *
 * The followings are the available columns in table '{{_product_service_category}}':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $display_order
 * @property integer $status
 * @property string $type
 * @property string $created_date
 */
class MasterDeveloper extends _BaseModel 
{
		
		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_master_developer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, slug, display_order, status, type, created_date', 'required', 'on'=>'abc'),
			array('name', 'required', 'on'=>'create, update'),
			array('display_order, status', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>200),
			array('type', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, slug, display_order, status, type, created_date', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'name' => Yii::t('translation','Name'),
			'slug' => Yii::t('translation','Slug'),
			'display_order' => Yii::t('translation','Display Order'),
			'status' => Yii::t('translation','Visibility'),
			'type' => Yii::t('translation','Type'),
			'created_date' => Yii::t('translation','Created Date'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('display_order',$this->display_order);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('created_date',$this->created_date,true);
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	
	public function activate()
        {
            $this->status = 1;
            $this->update();
        }



        public function deactivate()
        {
            $this->status = 0;
            $this->update();
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductServiceCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}

	public function behaviors()
	{
		return array('sluggable' => array(
				'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
				'columns' => array('name'),
				'unique' => true,
				'update' => true,
			),);
	}
        
        public static function getList() {
            $models=self::model()->findAll(array('condition'=>'status ='.STATUS_ACTIVE));
            return  CHtml::listData($models,'id', 'name');
        }

	public function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('t.status', 1);
		$criteria->compare('t.slug', $slug);
		return self::model()->find($criteria);
	}
}
