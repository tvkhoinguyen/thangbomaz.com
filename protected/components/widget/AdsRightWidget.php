<?php
class AdsRightWidget extends CWidget
{
    public function run()
    {        
        $this->getCategory();
    }
    
    public function getCategory()
    {
            $this->render(  'ads_right_widget', array(
                // 'model'=>$model
            ));
    }   
}