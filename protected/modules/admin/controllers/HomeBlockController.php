<?php

class HomeBlockController extends AdminController
{
    public $pluralTitle = 'Ads Banner Management';
    public $singleTitle = 'Ads Banner';
    public $cannotDelete = array();



    public function actionIndex() 
    {
        try {
            $model=new HomeBlock('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['HomeBlock']))
                $model->attributes=$_GET['HomeBlock'];

            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

    public function actionCreate() 
    {
        $this->pluralTitle = 'Ads Banner Management';
        $this->singleTitle = 'Ads Banner';

        $model= new HomeBlock('create');
        if(isset($_POST['HomeBlock']))
        {
            $model->attributes=$_POST['HomeBlock'];
            $model->type = 'adsbanner';
            // $model->status = STATUS_ACTIVE;
            if ($model->save())
            {
                $model->saveImage('image');
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created.');
                $this->redirect(array('view', 'id'=> $model->id));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }

        $this->render('update',array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name        ));

        // if($model->type=="service")
        // {
        //     $this->render('update1',array(
        //         'model' => $model,
        //         'actions' => $this->listActionsCanAccess,
        //         'title_name' => $model->name        ));
        // }else if($model->type=="index")
        // {
        //     $this->render('update2',array(
        //         'model' => $model,
        //         'actions' => $this->listActionsCanAccess,
        //         'title_name' => $model->name        ));
        // }
    }
    public function actionUpdate($id) 
    {
        $this->pluralTitle = 'Ads Banner Management';
        $this->singleTitle = 'Ads Banner';

        $model=$this->loadModel($id);
        if(isset($_POST['HomeBlock']))
        {
            $model->attributes=$_POST['HomeBlock'];
            $model->type = 'adsbanner';
            $model->status = $_POST['HomeBlock']['status'];
            if ($model->save())
            {
                $model->saveImage('image');
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                $this->redirect(array('view', 'id'=> $model->id));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }

        $this->render('update',array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name        ));

        // if($model->type=="service")
        // {
        //     $this->render('update1',array(
        //         'model' => $model,
        //         'actions' => $this->listActionsCanAccess,
        //         'title_name' => $model->name        ));
        // }else if($model->type=="index")
        // {
        //     $this->render('update2',array(
        //         'model' => $model,
        //         'actions' => $this->listActionsCanAccess,
        //         'title_name' => $model->name        ));
        // }
    }


    public function actionView($id) 
    {
        $this->pluralTitle = 'Ads Banner Management';
        $this->singleTitle = 'Ads Banner';
        try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function loadModel($id)
    {
        $initMode = new HomeBlock();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }


    public function actionAjaxActivate($id) 
    {
        if(Yii::app()->request->isPostRequest)
        {
            $model=ServiceBlock::model()->findByPk($id);
            if(method_exists($model, 'activate'))
            {
                $model->activate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
            
    }

    public function actionAjaxDeactivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model=ServiceBlock::model()->findByPk($id);
            if(method_exists($model, 'deactivate'))
            {
                $model->deactivate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404,'The requested page does not exist.');
        }
            
    }


    // 
    // 
    // 
    // 
    // 
    // 
    // 



    public function actionCreatePageBanner()
    {
        $this->pluralTitle = 'Page Banner Management';
            $this->singleTitle = 'Page Banner';
        try {
            $model = new PageBanner('create');
            if (isset($_POST['PageBanner'])) {
                $model->attributes = $_POST['PageBanner'];
                $model->type='pagebanner';
                $model->status=$_POST['PageBanner']['status'];
                if($model->save())
				{
					$model->saveImage('image');
					$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('viewPageBanner', 'id'=> $model->id));
				}
				else
					$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
            $this->render('createPageBanner', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
        }catch (exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException($e);
        }
    }

    public function actionIndexPageBanner() //manage About Us Block
    {
        try {
            $this->pluralTitle = 'Page Banner Management';
            $this->singleTitle = 'Page Banner';

            $model=new PageBanner();
            $model->type="pagebanner";
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['PageBanner']))
                $model->attributes=$_GET['PageBanner'];

            $this->render('indexPageBanner',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }
    public function actionUpdatePageBanner($id) 
    {
        $this->pluralTitle = 'Page Banner Management';
            $this->singleTitle = 'Page Banner';

        $model=PageBanner::model()->findByPk($id);
        if(isset($_POST['PageBanner']))
        {
            $model->attributes=$_POST['PageBanner'];
            $model->name=$_POST['PageBanner']['link'];
            $model->status=$_POST['PageBanner']['status'];
            // $model->price=$_POST['PageBanner']['price'];
            // $model->content=$_POST['PageBanner']['content'];
            // $model->status=$_POST['PageBanner']['status'];
            // $model->order_display=$_POST['PageBanner']['order_display'];
            $model->type='pagebanner';
            if ($model->save())
            {
                $model->saveImage('image');
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                $this->redirect(array('viewPageBanner', 'id'=> $model->id));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('updatePageBanner',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->name        ));
    }

    public function actionViewPageBanner($id) 
    {
        $this->pluralTitle = 'Page Banner Management';
        $this->singleTitle = 'Page Banner';
        try {
            $model = PageBanner::model()->findByPk($id);
            $this->render('viewPageBanner', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
}

    // public function actionDelete($id) {
    //     try {
    //         if(Yii::app()->request->isPostRequest) {
				// if (!in_array($id, $this->cannotDelete))
				// {
				// 	if($model = $this->loadModel($id))
    //                 {
    //                     $model->removeImage(array('image'), true);
				// 		if($model->delete())
				// 			Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
				// 	}
				// 	if(!isset($_GET['ajax']))
				// 		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				// }
    //         } else {
    //             Yii::log("Invalid request. Please do not repeat this request again.");
    //             throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    //         }
    //     } catch (Exception $e) {
    //         Yii::log("Exception ".  print_r($e, true), 'error');
    //         throw  new CHttpException($e);
    //     }
    // }      
    
    

        
    













    /*public function actionIndex2() //manage About Us Block
    {
        try {
            $this->pluralTitle = 'About Us Block Management';
            $this->singleTitle = 'About Us Block';

            $model=new AboutBlock();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['AboutBlock']))
                $model->attributes=$_GET['AboutBlock'];

            $this->render('index2',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

    public function actionUpdate2($id) 
    {
        $this->pluralTitle = 'About Us Block Management';
            $this->singleTitle = 'About Us Block';

        $model=AboutBlock::model()->findByPk($id);
        if(isset($_POST['AboutBlock']))
        {
            $model->attributes=$_POST['AboutBlock'];
            $model->name=$_POST['AboutBlock']['name'];
            $model->content=$_POST['AboutBlock']['content'];
            $model->status=$_POST['AboutBlock']['status'];
            $model->order_display=$_POST['AboutBlock']['order_display'];
            $model->type='aboutus';
            if ($model->save())
            {
                $model->saveImage('image');
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                $this->redirect(array('view2', 'id'=> $model->id));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update2',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->name        ));
    }

        
    public function actionView2($id) 
    {
        try {
            $this->pluralTitle = 'About Us Block Management';
            $this->singleTitle = 'About Us Block';

            $model=AboutBlock::model()->findByPk($id);
            $this->render('view2', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }




    public function actionIndex3() //manage About Us Block
    {
        try {
            $this->pluralTitle = 'Services Management';
            $this->singleTitle = 'Services';

            $model=new ServiceBlock();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ServiceBlock']))
                $model->attributes=$_GET['ServiceBlock'];

            $this->render('index3',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }
        public function actionCreate3()
        {
            try {
                $this->pluralTitle = 'Services Management';
                $this->singleTitle = 'Services';

                $model = new ServiceBlock('create');
                if (isset($_POST['ServiceBlock'])) {
                    $model->attributes = $_POST['ServiceBlock'];
                    $model->type='service';
                    if($model->save())
                    {
                        $model->saveImage('image');
                        $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                        $this->redirect(array('view3', 'id'=> $model->id));
                    }
                    else
                        $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
                }
                $this->render('create3', array(
                    'model' => $model,
                    'actions' => $this->listActionsCanAccess,
                ));
            }catch (exception $e) {
                Yii::log("Exception " . print_r($e, true), 'error');
                throw new CHttpException($e);
            }
        }
    public function actionUpdate3($id) 
    {
        $this->pluralTitle = 'Services Management';
            $this->singleTitle = 'Services';

        $model=ServiceBlock::model()->findByPk($id);
        if(isset($_POST['ServiceBlock']))
        {
            $model->attributes=$_POST['ServiceBlock'];
            $model->name=$_POST['ServiceBlock']['name'];
            $model->price=$_POST['ServiceBlock']['price'];
            $model->content=$_POST['ServiceBlock']['content'];
            $model->status=$_POST['ServiceBlock']['status'];
            $model->order_display=$_POST['ServiceBlock']['order_display'];
            $model->type='service';
            if ($model->save())
            {
                $model->saveImage('image');
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                $this->redirect(array('view3', 'id'=> $model->id));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update3',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->name        ));
    }

        
    public function actionView3($id) 
    {
        try {
            $this->pluralTitle = 'Services Management';
            $this->singleTitle = 'Services';

            $model=ServiceBlock::model()->findByPk($id);
            $this->render('view3', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }*/

    

	// public function actionDeleteAll()
	// {
	// 	$deleteItems = $_POST['home-block-grid_c0'];
	// 	$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

	// 	if (!empty($shouldDelete))
	// 	{
	// 		$deleteImages = Page::model()->findAll('id in (' . implode(',', $shouldDelete) . ')');if (!empty($deleteImages)){	foreach($deleteImages as $item){$item->removeImage(array('image'), true);}}			HomeBlock::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
	// 		$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
	// 	}
	// 	else
	// 		$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

	// 	if (!isset($_GET['ajax']))
	// 		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	// }
	
	// public function actionRemoveImage($fieldName, $id)
	// {
	// 	try
	// 	{
	// 		$model = $this->loadModel((int)$id);
	// 		$model->removeImage(array($fieldName));
	// 		echo 'thumbnail-' . $id;
	// 	}
	// 	catch (Exception $exc)
	// 	{
	// 		echo '';
	// 	}
	// }
		
    