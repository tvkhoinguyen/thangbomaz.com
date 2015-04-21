<?php
class PropertyListing extends _BaseModel
{
	public $uploadImageFolder = 'upload/property_listings'; //remember remove ending slash
	public $defineImageSize = array(
            'featured_image' => array(
                array('alias' => 'thumb1', 'size' => '200x150'),
                array('alias' => '640x350', 'size' => '640x350'),
            ), 
        );	
        
        public $positionOption = array(
            'north' => 'North',
            'east' => 'East',
            'south' => 'South',
            'west' => 'West'
        );
        
        public function tableName()
	{
		return '{{_property_listing}}';
	}
        
        public function rules() {
            return array(
                array('title, description, position', 'required', 'on' => 'create, update'),
                array('property_price, price', 'numerical'),
                array('contact_number', 'checkPhone'),
                array('position, title, status, property_type_id, floor_area_id, condition_id', 'safe', 'on' => 'search'),
                array('featured_image, status, slug, property_type_id, property_price, price, floor_area_id, condition_id, developer_id, tenure_id, lease_term_id, contact_name, contact_number, cea_reg, created_date', 'safe'),
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

        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
	
        
        public function attributeLabels()
	{
		return array(
                    'property_type_id' => Yii::t('translation','Property Type'),
                    'developer_id' => Yii::t('translation','Developer'),
                    'condition_id' => Yii::t('translation','Condition'),
                    'tenure_id' => Yii::t('translation','Tenure'),
                    'lease_term_id' => Yii::t('translation','Lease Term'),
                    'floor_area_id' => Yii::t('translation','Floor Area'),
                    'position' => Yii::t('translation','Derection'),
                    'title' => Yii::t('translation','Name'),
                );
        }
        
        public function behaviors()
	{
		return array('sluggable' => array(
                        'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                        'columns' => array('title'),
                        'unique' => true,
                        'update' => true,
                ),);
	}
	
	public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            $return =  array(
                'protype' => array(self::BELONGS_TO, 'PropertyType', 'property_type_id'),
                'mconditions' => array(self::BELONGS_TO, 'MasterCondition', 'condition_id'),
                'developer' => array(self::BELONGS_TO, 'MasterDeveloper', 'developer_id'),
                'tenure' => array(self::BELONGS_TO, 'MasterTenures', 'tenure_id'),
                'lease_term' => array(self::BELONGS_TO, 'MasterLeaseTerm', 'lease_term_id'),  
                'floor_area' => array(self::BELONGS_TO, 'MasterFloorArea', 'floor_area_id')
            );
            return $return;
        }
        
        public function search() {
            $criteria=new CDbCriteria;
            $criteria->compare('t.id',$this->id);
            $criteria->compare('t.title',$this->id,true);
            $criteria->compare('t.position', $this->position);
            $criteria->compare('t.property_type_id', $this->property_type_id);
            $criteria->compare('t.condition_id', $this->condition_id);
            $criteria->compare('t.floor_area_id', $this->floor_area_id);
            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
            ));
        }


        public static function getListActive($position) {
            $criteria = new CDbCriteria;
            $criteria->compare('t.status', STATUS_ACTIVE);
            $criteria->compare('t.position', $position);
            return new CActiveDataProvider('PropertyListing', array(
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

        public function nextOrderNumber()
	{
		return News::model()->count() + 1;
	}
}

