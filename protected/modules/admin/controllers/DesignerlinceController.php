<?php

class DesignerlinceController extends AdminController
{
    public $pluralTitle = 'License / Certificate Management';
    public $singleTitle = 'License / Certificate';
    public $cannotDelete = array();
    public $designerId ;
    public $baseControllerIndexUrl;

    protected function beforeAction($action){
        if($action->id !='ajaxActivate' && $action->id !='ajaxDeactivate' ){
            if(!isset($_GET['designerId'])){
                throw new CHttpException(404, 'The requested page does not exist.');
            }
            $model = InteriorDesign::model()->getInforRecord(trim($_GET['designerId']));
            if(empty($model)){
                 throw new CHttpException(404, 'The requested page does not exist.');
            }
            $this->designerId = $model;   
            $this->baseControllerIndexUrl  = Yii::app()->createAbsoluteUrl('admin/designerlince/index',array('designerId'=>$this->designerId->id));         
        }
        return parent::beforeAction($action);
    }

    public function actionCreate(){
        try {
            $model = new InteriorDesignLicense('create');
            if (isset($_POST['InteriorDesignLicense'])) {
                $model->attributes = $_POST['InteriorDesignLicense'];
                if($model->save())
				{
					$model->saveImage('image');
					$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('view','designerId'=>$this->designerId->id ,'id'=> $model->id));
				}
				else
					$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
            $this->render('create', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
        }catch (exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException($e);
        }
    }

    public function actionDelete($id) {
        try {
            if(Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
				if (!in_array($id, $this->cannotDelete))
				{
					if($model = $this->loadModel($id)){
						//call delete image first
                        $model->removeImage(array('image'), true);
						if($model->delete())
							Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
					}

					// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
					if(!isset($_GET['ajax']))
						$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
            } else {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }      
    
    public function actionIndex() {
        try {
            $model=new InteriorDesignLicense('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['InteriorDesignLicense']))
                $model->attributes=$_GET['InteriorDesignLicense'];
            $model->designer_id = $this->designerId->id;
            
            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

    public function actionUpdate($id) {
        $model=$this->loadModel($id);
        if(isset($_POST['InteriorDesignLicense']))
        {
            $model->attributes=$_POST['InteriorDesignLicense'];
            if ($model->save())
			{
				$model->saveImage('image');
				$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
				$this->redirect(array('view','designerId'=>$this->designerId->id ,'id'=> $model->id));
			}
			else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->title        ));
    }

    
    public function actionView($id) {
        try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->title            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

	/*
	* Bulk delete
	* If you don't want to delete some specified record please configure it in global $cannotDelete variable
	*/
	public function actionDeleteAll()
	{
		$deleteItems = $_POST['interior-design-license-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

		if (!empty($shouldDelete))
		{
            if(is_array($shouldDelete) && count($shouldDelete)>0){
                $allData = InteriorDesignLicense::model()->findAllByAttributes(array("id"=>$shouldDelete));    
                foreach($allData as $model){
                     $model->removeImage(array('image'), true);
                    $model->delete();
                }
            }
			//$deleteImages = Page::model()->findAll('id in (' . implode(',', $shouldDelete) . ')');if (!empty($deleteImages)){	foreach($deleteImages as $item){$item->removeImage(array('image'), true);}}			InteriorDesignLicense::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect($this->baseControllerIndexUrl);
	}
	
		/*
	* Remove upload image 
	* Only files are deleted not folder. Run in ajax mode. Can modify in custom.js admin theme
	*/
	public function actionRemoveImage($fieldName, $id)
	{
		try
		{
			$model = $this->loadModel((int)$id);
			$model->removeImage(array($fieldName));
			echo 'thumbnail-' . $id;
		}
		catch (Exception $exc)
		{
			echo '';
		}
	}
		
    public function loadModel($id){
		//need this define for inherit model case. Form will render parent model name in control if we don't have this line
		$initMode = new InteriorDesignLicense();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}