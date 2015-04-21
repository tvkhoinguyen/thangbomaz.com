<?php

class CategoryTinController extends AdminController
{
    public $pluralTitle = 'Category Tin';
    public $singleTitle = 'Category Tin';
    public $cannotDelete = array();
    public function actionCreate()
    {
        $model = new CategoryTin('createParent');
            if (isset($_POST['CategoryTin'])) {
                $model->attributes = $_POST['CategoryTin'];
                $model->parent_id = 0;
                $model->created_date = $model->updated_date = date('Y-m-d H:i:s');
                if($model->save())
                {
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('view', 'id'=> $model->id));
                }
                else
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
            $this->render('createParent', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
    }
    public function actionDelete($id) {
        try {
            if(Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
				if (!in_array($id, $this->cannotDelete))
				{
					if($model = $this->loadModel($id)){
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
            $model=new CategoryTin('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['CategoryTin']))
                $model->attributes=$_GET['CategoryTin'];

            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }
    public function actionIndexSub($p_id) 
    {
            $model=new CategoryTin('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['CategoryTin']))
                $model->attributes=$_GET['CategoryTin'];

            $this->render('indexSub',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
                'p_id'=>$p_id,
            ));
    }

    public function actionCreateSub($p_id)
    {
        $model = new CategoryTin('createSub');
            if (isset($_POST['CategoryTin'])) 
            {
                $model->attributes = $_POST['CategoryTin'];
                $model->parent_id = $p_id;
                $model->created_date = $model->updated_date = date('Y-m-d H:i:s');
                if($model->save())
                {
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('indexSub', 'id'=> $model->id, 'p_id'=>$p_id));
                }
                else
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
            $this->render('createSub', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
                'p_id'=>$p_id,
            ));
    }

    public function actionUpdateSub($id, $p_id) 
    {
        $model=$this->loadModel($id);
        $model->scenario = 'updateSub';
        if(isset($_POST['CategoryTin']))
        {
            $model->attributes=$_POST['CategoryTin'];
            $model->parent_id = $p_id;
            $model->updated_date = date('Y-m-d H:i:s');
            if ($model->save())
            {
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                $this->redirect(array('indexSub', 'id'=> $model->id, 'p_id'=>$p_id));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('updateSub',array(
            'model' => $model,
            'p_id'=>$p_id,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->name        ));
    }

    public function actionViewSub($id, $p_id) {
        try {
            $model = $this->loadModel($id);
            $this->render('viewSub', array(
                'model'=> $model,
                'p_id'=>$p_id,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
    

    public function actionUpdate($id) {
        $model=$this->loadModel($id);
        $model->scenario = 'updateParent';
        if(isset($_POST['CategoryTin']))
        {
            $model->attributes=$_POST['CategoryTin'];
            $model->parent_id = 0;
            $model->updated_date = date('Y-m-d H:i:s');
            if ($model->save())
			{
				$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
				$this->redirect(array('view', 'id'=> $model->id));
			}
			else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('updateParent',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->name        ));
    }

    
    public function actionView($id) {
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

	/*
	* Bulk delete
	* If you don't want to delete some specified record please configure it in global $cannotDelete variable
	*/
	public function actionDeleteAll()
	{
		$deleteItems = $_POST['category-tin-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

		if (!empty($shouldDelete))
		{
						CategoryTin::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
		
    public function loadModel($id){
		//need this define for inherit model case. Form will render parent model name in control if we don't have this line
		$initMode = new CategoryTin();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}