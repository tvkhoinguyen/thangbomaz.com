<?php

/**
 * This is the model class for table "{{_home_products}}".
 *
 * The followings are the available columns in table '{{_home_products}}':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $telephone
 * @property string $website
 * @property integer $status
 * @property string $slug
 * @property integer $is_featured
 * @property string $created_date
 */
class HomeProducts extends _BaseModel {
		
	public $uploadImageFolder = 'upload/home_products'; //remember remove ending slash
	public $defineImageSize = array(
            'featured_image' => array(
                array('alias' => 'thumb1', 'size' => '170x137'),
                array('alias' => '640x200', 'size' => '640x200'),
            ), 
        );
        
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
            return '{{_home_products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('status, is_featured', 'numerical', 'integerOnly'=>true),
                    array('name, address, website, slug', 'length', 'max'=>250),
                    array('telephone', 'checkPhone'),
                    array('website', 'url'),
                    array('telephone', 'length', 'max'=>50),
                    array('name, description', 'required', 'on' => 'create, update'), 
                    array('description, featured_image, product_service_id', 'safe'),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('id, name, address, telephone, website, status, slug, is_featured, created_date, product_service_id', 'safe', 'on'=>'search'),
            );
	}
        
        public function checkPhone($attribute, $params) {
            if ($this->$attribute != '') {
                $pattern = '/^[\+]?[\(]?(\+)?(\d{0,3})[\)]?[\s]?[\-]?(\d{0,9})[\s]?[\-]?(\d{0,9})[\s]?[x]?(\d*)$/';
                $containsDigit = preg_match($pattern, $this->$attribute);
                $lb = $this->getAttributeLabel($attribute);
                if (!$containsDigit)
                    $this->addError($attribute, "$lb must be numerical and  allow input (),+,-");
            }
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'product_service_category' => array(self::BELONGS_TO, 'ProductServiceCategory', 'product_service_id'),
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
                    'address' => Yii::t('translation','Address'),
                    'telephone' => Yii::t('translation','Telephone'),
                    'website' => Yii::t('translation','Website'),
                    'status' => Yii::t('translation','Status'),
                    'slug' => Yii::t('translation','Slug'),
                    'is_featured' => Yii::t('translation','Is Featured'),
                    'product_service_id' => Yii::t('translation', 'Product Service Category'),
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_featured',$this->is_featured);
                $criteria->compare('product_service_id', $this->product_service_id);
		$criteria->compare('created_date',$this->created_date,true);					
		 
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=> Yii::app()->params['defaultPageSize'],
                    ),
                    'sort' => array(
                        'defaultOrder' => 't.id DESC'
                    )
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
        
        public static function getListActive($position) {
            $criteria = new CDbCriteria;
            $criteria->compare('t.status', STATUS_ACTIVE);
            return new CActiveDataProvider('HomeProducts', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => ITEM_PAGING,
                ),
                'sort' => array(
                    'defaultOrder' => 't.id DESC'
                )
            ));
        }

        public static function findBySlug($slug) {
            $criteria = new CDbCriteria;
            $criteria->compare('t.slug', $slug);
            return self::model()->find($criteria);
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

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HomeProducts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return HomeProducts::model()->count() + 1;
	}
}
