<?php

/*
 * DTOAN
 * List life style
 * 6-12-2013
 */
class LifestyleWidget extends CWidget
{

    public $limitItem =9;

    public function run()
    {        
        $this->getContent();
    }
    
    public function getContent()
    {
        $data = $this->getListLifeStyleHomepage();
        $this->render('LifestyleWidget/list',array('data'=>$data->getData()));
    }   

    public function getListLifeStyleHomepage(){
            $criteria = new CDbCriteria;
            $criteria->compare('t.status', STATUS_ACTIVE);
            return new CActiveDataProvider('Lifestyle', array(
                'criteria' => $criteria,
                'pagination' => array(
                        'pageSize' => $this->limitItem,
                ),
                'sort' => array(
                    'defaultOrder' => 't.id DESC'
                )
            ));
    }





}