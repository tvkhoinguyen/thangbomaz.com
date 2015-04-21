<?php
class SiteController extends FrontController
{

    public $attempts = MAX_TIME_TO_SHOW_CAPTCHA;
    public $counter;

    public function actionGetListTin($type)
    {
        $this->pageTitle = 'Tin Tức ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        if($type=='vnexpress')
        {
            $this->render('get_list_tin', array(
                // 'model' => $model,
                'breadcrum'=>'Tin Tức Từ VnExpress',
            ));
        }

        if($type=='bbc')
        {
            $this->render('get_list_tin_bbc', array(
                // 'model' => $model,
                'breadcrum'=>'Tin Tức Từ BBC',
            ));
        }
        if($type=='rfi')
        {
            $this->render('get_list_tin_rfi', array(
                // 'model' => $model,
                'breadcrum'=>'Tin Tức Từ RFI',
            ));
        }

        if($type=='vov')
        {
            $this->render('get_list_tin_vov', array(
                // 'model' => $model,
                'breadcrum'=>'Tin Tức Từ VOV',
            ));
        }
    }

    
    public function actionVideo()
    {
        $this->pageTitle = 'Video ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $this->render('video_home', array(
            // 'model' => $model,
        ));
    }

    public function actionVideoDetail($slug)
    {
        $model = Video::getDetailBySlug($slug);
       
        $model->view = $model->view+1;
        $model->update(array('view'));
        $this->pageTitle = $model->title . ' - ' . Yii::app()->params['defaultPageTitle'];
        $this->render('video_detail', array(
            'model' => $model,
        ));
    }

    public function actionListVideo($slug)
    {
        $this->pageTitle = 'Video ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $criteria = new CDbCriteria();
        $criteria->compare('t.slug',$slug);
        $c_video = CategoryVideo::model()->find($criteria);
        if(empty($c_video))
        {
            throw new CHttpException(404, 'The request page does not exist.');
        }
        $this->pageTitle = $c_video->name. ' - ' . Yii::app()->params['defaultPageTitle'];
        
        // $model=new Video('search');
        // $model->category_video_id = $c_video->id;
        // $model->status = 1;
        // // $model->unsetAttributes();
        // if(isset($_GET['Video']))
        //     $model->attributes=$_GET['Video'];

        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.category_video_id', $c_video->id);
        $dataProvider =  new CActiveDataProvider('Video', array(
            'criteria' => $criteria,
            'pagination' => array(
                    'pageSize' => 10,
                    // 'pageSize' => Yii::app()->params['defaultPageSize'],
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC'
            )
        ));

        $this->render('video_list', array(
            // 'model' => $model,
            'title'=>$c_video->name,
            'dataProvider'=>$dataProvider,
        ));
    }


    public function actionListTin()
    {
        $p_slug = $_GET['p_slug'];
        $c_slug = $_GET['c_slug'];
        $breadcrum = '';
        if($c_slug!='' && !empty($c_slug))
        {
            $c_cate_tin = CategoryTin::getDetailBySlug($c_slug);
            if(!empty($c_cate_tin))
            {
                $criteria = new CDbCriteria;
                $criteria->compare('t.status', STATUS_ACTIVE);
                $criteria->compare('t.category_sub_id', $c_cate_tin->id);
                $dataProvider =  new CActiveDataProvider('ThoiSu', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                            // 'pageSize' => 10,
                            'pageSize'=>Yii::app()->setting->getItem('pageSizeListTin'),
                            // 'pageSize' => Yii::app()->params['defaultPageSize'],
                    ),
                    'sort' => array(
                        'defaultOrder' => 't.id DESC'
                    )
                ));
                $title = $c_cate_tin->name;
                $this->pageTitle = $c_cate_tin->name. ' - ' . Yii::app()->params['defaultPageTitle'];
                //breadcrum
                $sub = $c_cate_tin;
                $parent = CategoryTin::getDetailBySlug($p_slug);
                if(!empty($sub) && !empty($parent))
                {
                    $breadcrum.='<span class="main-cat-title">';
                    $breadcrum.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>'' )).'">'.$parent->name.'</a>';
                    $breadcrum.='<span class="glyphicon glyphicon-fast-forward"> > </span>';
                    $breadcrum.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>$sub->slug )).'">'.$sub->name.'</a>';
                    $breadcrum.='</span>';
                }

            }else 
                throw new CHttpException(404, 'Sorry! The request page does not exist.');
        }else if( empty($c_slug) && !empty($p_slug) )
        {
            $p_cate_tin = CategoryTin::getDetailBySlug($p_slug);
            if(!empty($p_cate_tin))
            {
                $criteria = new CDbCriteria;
                $criteria->compare('t.status', STATUS_ACTIVE);
                $criteria->compare('t.category_parent_id', $p_cate_tin->id);
                $dataProvider =  new CActiveDataProvider('ThoiSu', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                            // 'pageSize' => 10,
                        'pageSize'=>Yii::app()->setting->getItem('pageSizeListTin'),
                            // 'pageSize' => Yii::app()->params['defaultPageSize'],
                    ),
                    'sort' => array(
                        'defaultOrder' => 't.id DESC'
                    )
                ));
                $title = $p_cate_tin->name;
                $this->pageTitle = $p_cate_tin->name. ' - ' . Yii::app()->params['defaultPageTitle'];
                //breadcrum
                $parent = $p_cate_tin;
                if( !empty($parent))
                {
                    $breadcrum.='<span class="main-cat-title">';
                    $breadcrum.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>'' )).'">'.$parent->name.'</a>';
                    $breadcrum.='</span>';
                }
            }
        }

        $this->render('list_tin', array(
            // 'model' => $model,
            'title'=>$title,
            'dataProvider'=>$dataProvider,
            'breadcrum'=>$breadcrum,
        ));
    }

    public function actionTinDetail($slug)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('t.status',STATUS_ACTIVE);
        $criteria->compare('t.slug',$slug);
        $model = ThoiSu::model()->find($criteria);

        //Tin hot

        //Tin lien quan

        //Tin moi cap nhat

        //Tin xem nhieu

        if(!empty($model))
        {
            $model->view = $model->view +1;
            $model->update( array('view') );
            $this->pageTitle = $model->title. ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->render('tin_detail', array(
                'model' => $model,
                // 'title'=>$title,
                // 'dataProvider'=>$dataProvider,
            ));
        }else
            throw new CHttpException(404, 'Sorry! The request page does not exist.');

    }











    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('actions'),
                'users' => array('*'),
            ),
        );
    }
    
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
            'ajax.'=>'application.components.widget.RegistorWidget',
            'ajaxlogin.'=>'application.components.widget.LoginWidget',
            'ajaxjoin.'=>'application.components.widget.JoinWidget',
        );
    }
    
    private function captchaRequired() {
        return Yii::app()->session->itemAt('captchaRequired') >= $this->attempts;
    }


    public function actionAboutUs()
    {
        $this->pageTitle = 'About Us - ' . Yii::app()->setting->getItem('defaultPageTitle');
        $model7 = AboutBlock::model()->findByPk(7);
        $model8 = AboutBlock::model()->findByPk(8);
        $this->render('aboutus', array('model7' => $model7, 'model8' => $model8));
    }

    public function actionServices()
    {
        $this->pageTitle = 'Services - ' . Yii::app()->setting->getItem('defaultPageTitle');
        $models = Services::getListActive();
        $this->render('services', array('model' => $models));
    }

    public function actionServiceDetail($slug) {
        $model = Services::findBySlug($slug);
        $this->pageTitle = $model->name . ' - ' . Yii::app()->setting->getItem('defaultPageTitle');
        $this->render('service_detail', array('model' => $model));
    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    protected function performAjaxValidation($model)
    {
        try {
            if (isset($_POST['ajax'])) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException("Exception " . print_r($e, true));
        }
    }


    public function actionIndex()
    {
        $this->pageTitle = Yii::app()->setting->getItem('defaultPageTitle');
       
        $this->render('index', array(
            // 'email' => $email,
            // 'error' => $error
        ));
    }

    public function actionContactUs()
    {
        $this->pageTitle = 'Contact Us ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $this->showFullScreen =true;
        $this->showBanner     = false;
        $model = new ContactForm('create');
        //auto fill
        // if (isset(Yii::app()->user->id)) {
        //     $mUser = Users::model()->findByPk(Yii::app()->user->id);
        //     if ($mUser) {
        //         $model->name = $mUser->full_name;
        //         $model->email = $mUser->email;
        //         $model->phone = $mUser->phone;
        //         $model->company = $mUser->company;
        //     }

        // }
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) 
            {
                $model->message = '<br>' . nl2br($model->message);
                
                if (!empty($model->email)) 
                {
                    SendEmail::confirmContactMailToUser($model);
                }
                SendEmail::sendContactMailToAdmin($model);

                Yii::app()->user->setFlash('msg', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            } else {
                Yii::log(print_r($model->getErrors(), true), 'error', 'SiteController.actionContact');
            }
        }

        $this->render('contact_us', array(
            'model' => $model,
        ));
    }


    public function actionSpecialDeals() {
        $this->pageTitle = 'Special Deals ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $model = SpecialDeals::getListActive();
        $snatchModel = new SnatChForm();
        $this->render('special_deals', array(
            'model' => $model,
            'snatch' => $snatchModel
        ));
    }
    
    public function actionSpecialDetail($slug) {
        try {
            $model = SpecialDeals::findBySlug($slug);
            $this->pageTitle = $model->title . ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->render('special_detail', array('model' => $model));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
    
    public function actionLifeStyle() {
        $this->pageTitle = 'Lifestyle ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $model = Lifestyle::getListActive();
        $this->render('lifestyle', array(
            'model' => $model
        ));
    }
    
    public function actionLifestyleDetail() {
        try {
            $model = Lifestyle::findBySlug($slug);
            $this->pageTitle = $model->title . ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->render('lifestyle_detail', array('model' => $model));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
    
    public function actionPropertyListing($position = 'north') {
        try {
            $this->pageTitle = 'Propery Listing ' . ' - ' . Yii::app()->params['defaultPageTitle'];
            $model = PropertyListing::getListActive($position);
            $this->render('property_listing', array(
                'model' => $model
            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
    
    public function actionHomeProduct() {
        try {
            $this->pageTitle = 'Home Products - ' . Yii::app()->params['defaultPageTitle'];
            $model = HomeProducts::getListActive();
            $this->render('home_product', array(
                'model' => $model
            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }    
    }
    
    public function actionHomeProductDetail($slug) {
        try {
            $model = HomeProducts::findBySlug($slug);
            $this->pageTitle = $model->name . ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->render('home_product_detail', array(
                'model' => $model
            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionPropertyListingDetail() {
        try {
            $model = PropertyListing::findBySlug($slug);
            $this->pageTitle = $model->title . ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->render('property_listing_detail', array('model' => $model));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
    
    public function actionNewsEvent($type = 'news') {
        try {
            $this->pageTitle = 'News and Events - ' . Yii::app()->params['defaultPageTitle'];
            $model = News::getListActive($type);
            $this->render('news_event', array(
                'model' => $model
            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }  
    }
    
    public function actionNewsEventDetail($slug) {
        try {
            $model = News::findBySlug($slug);
            $this->pageTitle = $model->title . ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->render('news_event_detail', array('model' => $model));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionListDesigner() {
        try {
            $this->pageTitle = 'Interior Designers ' . ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->showBanner = false;
            $this->render('designer/list');
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionDesignerdetail($slug) {
        try {
            $this->pageTitle = 'Interior Designers detail ' . ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->showBanner = false;
            $model = InteriorDesign::model()->getDetailBySlug(trim($slug));
            if(empty($model)){
                throw new CHttpException(404, 'The requested page does not exist.');
            }
            $this->render('designer/detail',array('model'=>$model));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionProcessenquiry($type,$slug=null){
        $this->layout=false;
        $arrayDesinger=array();
        $arrSelect    = array();
        $flag         = false;

        if($type=='single'){
            $infoDesinger = InteriorDesign::model()->getDetailBySlug(trim($slug));
            if($infoDesinger){
                $arrayDesinger[$infoDesinger->id] = $infoDesinger->interior_name;
                $arrSelect[$infoDesinger->id]=array('selected'=>true);
                $flag=true;
            }
        }else{
            $arrSession = array();
            if(isset(Yii::app()->session[SESSION_ENQUIRY])){
                $arrSession = Yii::app()->session[SESSION_ENQUIRY];
                if(is_array($arrSession)&& count($arrSession)>0){
                    $data = InteriorDesign::model()->getListDesignerWithID($arrSession);
                    if(is_array($data) && count($data)>0){
                        foreach($data as $designer){
                            $arrayDesinger[$designer->id] = $designer->interior_name;
                            $arrSelect[$designer->id]     = array('selected'=>true);                           
                        }
                        $flag=true;
                    }
                }
            }
        }

        // not data or session
        if(!$flag){
             die( "<script>
                   parent.$('#Loadpopup').modal('hide');
                   parent.$('#modalAddEmquiry .modal-body').html('Please select designer')
                   parent.$('#modalAddEmquiry').modal('show');
                </script>"
            );                   
        }

        $model = new Enquiry('create');
        if(isset($_POST['Enquiry'])){
            $model->attributes = $_POST['Enquiry'];
            $model->validate();
            if(!$model->hasErrors()){
               $model->designer_name = (is_array($model->designer_name)&& count($model->designer_name)>0) ? json_encode($model->designer_name) : json_encode(array());
               if($model->save()){
                    //chua xen mail
                    $arrName = json_decode( $model->designer_name,true);
                    if(is_array($arrName)&& count($arrName)>0){
                        $arrEmailDeSinger = InteriorDesign::model()->getListDesignerWithID(json_decode($model->designer_name,true));
                        if(is_array($arrEmailDeSinger)&& count($arrEmailDeSinger)>0){
                            foreach($arrEmailDeSinger as $mDesinger){
                                SendEmail::sendMailEnquiryToDesinger($model,$mDesinger);
                            }
                            //send mail admin
                            SendEmail::sendMailEnquiryToAdmin($model);
                        }
                    }

                    //remove session
                    $idRemoveEnquiry = '';
                    if($type !='single'){
                        unset(Yii::app()->session[SESSION_ENQUIRY]);
                        $idRemoveEnquiry = "parent.$('#total-enquiry').html('0 Selected');";
                    }
                    die( "<script>
                           $idRemoveEnquiry
                           parent.$('#Loadpopup').modal('hide');
                           parent.$('#ModalThankyou').modal('show');
                        </script>"
                    );
               } 
            }
        }
        $this->render('add_enquiry',array('model'=> $model,'arrayDesinger'=>$arrayDesinger,'type'=>$type,'arrSelect'=>$arrSelect));
    }

    public function actionAddenquiry($desingerid){
        $this->layout=false;
        $arrSession = array();
        if(is_numeric($desingerid) && $desingerid>0){
            if(isset(Yii::app()->session[SESSION_ENQUIRY])){
                $arrSession = Yii::app()->session[SESSION_ENQUIRY];
            }
            $arrSession[$desingerid] =$desingerid;
            Yii::app()->session[SESSION_ENQUIRY]=$arrSession;
        }
        echo count($arrSession);die();
    }
    
    public function actionSnatchNow() {
        $this->layout = false;
        if (Yii::app()->request->isPostRequest) {
            $model = new SnatChForm();
            $model->attributes = $_POST['SnatChForm'];
            if ($model->validate()) {
                $id = $model->id;
                $email = $model->email;
                $deal = SpecialDeals::model()->findByPk($id);
                $link = Yii::app()->createAbsoluteUrl('site/specialDetail', array('slug' => $deal->slug));
                $deal_name = $deal->title;
                SendEmail::snatchNow($email, $link, $deal_name);
                $status = 1;
            } else {
                $status = 0;
            }
            $this->renderPartial('snatch_now', array(
                'snatch' => $model,
                'status' => $status
            ), false, true);
        } else {
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
        }
    }
    public function actionSearch($keyword=null){
        try {
            $this->pageTitle = 'Search Interior Designers ' . ' - ' . Yii::app()->params['defaultPageTitle'];
            $this->showBanner = false;
            $this->render('designer/search',array('keyword'=>$keyword));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

}