<?php

/*
 * DTOAN
 * List item designer
 * 6-12-2013
 */
class ListDesignerWidget extends CWidget
{

    public $limitItem =9;
    public $position;
    public $keyword=null;
    /**
     * 1: Feature home page
     * 2 : List item feature
     */

    public function run()
    {        
        $this->getContent();
    }
    
    public function getContent()
    {
        if($this->position==1){
           $model= $this->getListFeatured();
        }

        if($this->position==2){
           $model= $this->getListItem();
        }

        
    }   

    public function getListFeatured(){
        $model = new InteriorDesign();
        $model->unsetAttributes();
        $model->status =STATUS_ACTIVE;
        $model->feature_designer = STATUS_ACTIVE;
        $data = $model->getListFeaturedHomePage($this->limitItem);
        $this->render('ListDesignerWidget/feature',array('model'=>$data->getData()));
    }

    public function getListItem(){
        $model = new InteriorDesign();
        $model->unsetAttributes();
        $model->status =STATUS_ACTIVE;
        if($this->keyword !=''){
            $model->interior_name = strip_tags(trim($this->keyword));
        }

        $data = $model->getListFeaturedHomePage($this->limitItem);
        $this->render('ListDesignerWidget/list',array('model'=>$data));
    }

}