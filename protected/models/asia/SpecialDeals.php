<?php
class SpecialDeals extends _BasePost 
{
	public $uploadImageFolder = 'upload/cms'; //remember remove ending slash
	public $defineImageSize = array(
            'featured_image' => array(
                array('alias' => 'thumb1', 'size' => '200x150'),
                array('alias' => '640x350', 'size' => '640x350'),
            ), 
        );	
	public $pageType = 'special_deals';
	public $categoryId;
        
        public function rules() {
            return array(
                array('retail_price, now_price', 'numerical', 'min' => 0),
                array('title, short_content, content, meta_desc', 'required', 'on' => 'create, update'),
                array('status, post_type', 'safe'),
            );
        }


        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
	
	public function defaultScope()
        {
            return array(
                'condition'=>"post_type='" . $this->pageType . "'",
            );
        }
        
        public function attributeLabels()
	{
		return array(
                    'short_content' => Yii::t('translation', 'Description'),
                    'content' => Yii::t('translation', 'Details'),
                    'meta_desc' => Yii::t('translation', 'Contact Details'),
                );
        }
	
	public function relations() {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            $return =  array(
                'postsCategories' => array(self::HAS_MANY, 'PostsCategories', 'post_id', 'joinType' => 'INNER JOIN'),
                'category' => array(self::HAS_MANY, 'NewsCategory', array('category_id' => 'id'), 'through' => 'PostsCategories', 'joinType' => 'INNER JOIN'),
                'categoryLink' => array(self::MANY_MANY, 'NewsCategory', $this->tablePrefix() . '_posts_categories(post_id, category_id)', 'together' => true, 'joinType' => 'LEFT JOIN'),
            );
            return $return;
        }
	
	public static function getListActive() {
            $criteria = new CDbCriteria;
            $criteria->compare('t.status', STATUS_ACTIVE);
            $criteria->condition = ' t.post_type = "special_deals" ';
            // $criteria->compare('t.post_type', 'special_deals');
            return new CActiveDataProvider('SpecialDeals', array(
                'criteria' => $criteria,
                'pagination' => array(
                        'pageSize' => Yii::app()->params['defaultPageSize'],
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

