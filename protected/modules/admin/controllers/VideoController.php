<?php

class VideoController extends AdminController
{
    public $pluralTitle = 'Video';
    public $singleTitle = 'Video';
    public $cannotDelete = array();
    public function actionCreate(){
        try {
            $model = new Video('create');
            if (isset($_POST['Video'])) {
                $model->attributes = $_POST['Video'];
                $model->link = $_POST['Video']['link'];
                if(!empty($model->link))
                {
                    $tmp_arr = explode('?v=', $model->link);
                    if(!empty($tmp_arr[1]))
                    {
                        $model->image = 'http://img.youtube.com/vi/'.$tmp_arr[1].'/2.jpg';
                    }
                }

                if($model->save())
				{
					// $model->saveImage('image');
					$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('view', 'id'=> $model->id));
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

    public function actionDelete($id)
    {
        try
        {
            if (Yii::app()->request->isPostRequest)
            {
                // we only allow deletion via POST request
                if (!in_array($id, $this->cannotDelete))
                {
                    if ($model = $this->loadModel($id))
                    {
                        if ($model->delete())
                            Yii::log("Delete record " . print_r($model->attributes, true), 'info');
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
            } else
            {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        }
        catch (Exception $e)
        {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException($e);
        }
    }     
    
    public function actionIndex() {
        try {
            $model=new Video('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Video']))
                $model->attributes=$_GET['Video'];

                $this->render('index',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
                ));
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

    public function actionUpdate($id) 
    {
        $model=$this->loadModel($id);
        if(isset($_POST['Video']))
        {
            $model->attributes=$_POST['Video'];
            $model->link = $_POST['Video']['link'];
            if(!empty($model->link))
            {
                $tmp_arr = explode('?v=', $model->link);

                if(!empty($tmp_arr[1]))
                {
                    $model->image = 'http://img.youtube.com/vi/'.$tmp_arr[1].'/2.jpg';
                }
            }
            // echo '<pre>';
            // print_r($model->image);
            // echo '</pre>';
            // die;
            $model->updated_date = date('Y-m-d H:i:s');
            if ($model->save())
			{
				// $model->saveImage('image');
				$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
				$this->redirect(array('view', 'id'=> $model->id));
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

	
    public function actionDeleteAll()
    {
        $deleteItems = $_POST['video-grid_c0'];
        $shouldDelete = array_diff($deleteItems, $this->cannotDelete);

        if (!empty($shouldDelete))
        {
            Video::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
            $this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
        }
        else
            $this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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
		$initMode = new Video();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}