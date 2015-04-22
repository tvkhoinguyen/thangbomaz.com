<?php

class TinTucThoiSuController extends AdminController
{
    public $pluralTitle = 'Thời Sự';
    public $singleTitle = 'Thời Sự';
    public $cannotDelete = array();
    public function actionCreate()
    {
        try {
            $model = new ThoiSu('create');
            $model->status=1;
            $model->is_marquee = 0;
            $model->is_hot = 1;
            $model->is_home = 1;
            $model->is_default = 0;
            $model->is_bai_hot = 0;
            // 'is_marquee'=>'Slide Chạy Mỗi Chuyên Mục',
            // 'is_hot'=>'Nổi Bật Mỗi Chuyên Mục',
            // 'is_home' => Yii::t('translation','Nằm Home Mỗi Chuyên Mục'),
            // 'is_default' => Yii::t('translation','Nằm Ở Trang Chủ'),
            // 'is_bai_hot' => Yii::t('translation','Bài Hot Nằm Ở Trang Chủ'),
            
            if (isset($_POST['ThoiSu'])) {
                $model->attributes = $_POST['ThoiSu'];
                $model->created_date = $model->updated_date = date('Y-m-d H:i:s');
                $model->view = 1;
                if($model->save())
				{
					$model->saveImage('image');
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
            $model=new ThoiSu('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ThoiSu']))
                $model->attributes=$_GET['ThoiSu'];

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
        if(isset($_POST['ThoiSu']))
        {
            $old_image = $model->image;
            foreach ($model->defineImageSize as $key => $value) {
                $imageField=$key;
            }
            $uploadImage = CUploadedFile::getInstance($model, $imageField);

            $model->attributes=$_POST['ThoiSu'];
            $model->updated_date = date('Y-m-d H:i:s');
            $model->view = $model->view+1 ;
            if ($model->save())
			{
				if( empty($uploadImage) || $uploadImage==NULL )
                {
                    $model->image = $old_image;
                    $model->update( array($imageField) );
                }else{
                    $model->saveImage($imageField);
                    $model->deleteImages($imageField, $old_image);
                }
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
            $model->view = $model->view+1;
            $model->update(array('view'));
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
		$deleteItems = $_POST['ThoiSu-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

		if (!empty($shouldDelete))
		{
			$deleteImages = Page::model()->findAll('id in (' . implode(',', $shouldDelete) . ')');if (!empty($deleteImages)){	foreach($deleteImages as $item){$item->removeImage(array('image'), true);}}			ThoiSu::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
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
		$initMode = new ThoiSu();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}