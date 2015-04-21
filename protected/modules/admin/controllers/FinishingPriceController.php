<?php

class FinishingPriceController extends AdminController {

    public $pluralTitle = 'Finishing Management';
    public $singleTitle = 'Finishing';
    public $cannotDelete = array();

    public function actionCreate($cateId) {
        $modelCate = PrintCategories::model()->findByPk($cateId);
        if ($modelCate) {
            $model = new Finishing('create');
            $model->print_category_id = $modelCate->id;
            if (isset($_POST['Finishing'])) {
                $model->attributes = $_POST['Finishing'];
                if ($model->validate()) {
                    $model->nextOrderNumber();
                    $model->status = STATUS_ACTIVE;
                    $sizePapers = $_POST['Finishing']['size_paper'];
                    $cateUnit = PrintPrice::model()->getSetlHasConfig($modelCate->id);
                    $printingSide = PrintPrice::model()->getSidelHasConfig($modelCate->id);
                    if ($model->save() && count($cateUnit > 0)) {
                        foreach ($cateUnit as $val) {
                            foreach ($sizePapers as $paper) {
                                if ($printingSide) {
                                    foreach ($printingSide as $side) {
                                        $this->saveRecord($modelCate->id, $val['set_id'], $paper, $model->id, $side['printing_side_id']);
                                    }
                                } else {
                                    $this->saveRecord($modelCate->id, $val['set_id'], $paper, $model->id, 0);
                                }
                            }
                        }
                    }
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('create', 'cateId' => $modelCate->id));
                } else {
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
                }
            }
            $this->render('create', array(
                'model' => $model,
                'modelCate' => $modelCate,
                'actions' => $this->listActionsCanAccess,
            ));
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
    
    public function saveRecord($cateId, $setId, $sizePaperId, $finishingId, $pringtingSideId, $price = 0)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('print_category_id', $cateId);
        $criteria->compare('set_id', $setId);
        $criteria->compare('size_paper_id', $sizePaperId);
        $criteria->compare('finishing_id', $finishingId);
        $criteria->compare('printing_side_id', $pringtingSideId);
        $printFinisingPrice = FinishingPrice::model()->find($criteria);
        if (!$printFinisingPrice) {
            $printFinisingPrice = new FinishingPrice();
            $printFinisingPrice->print_category_id = $cateId;
            $printFinisingPrice->set_id = $setId;
            $printFinisingPrice->size_paper_id = $sizePaperId;
            $printFinisingPrice->finishing_id = $finishingId;
            $printFinisingPrice->printing_side_id = $pringtingSideId;
        }
        $printFinisingPrice->price = $price;
        $printFinisingPrice->save(false);
    }

    public function actionUpdate($id) {
        $model = Finishing::model()->findByPk($id);
        $model->scenario = "update";
        if ($model) {
            $modelCate = PrintCategories::model()->findByPk($model->print_category_id);
            if (isset($_POST['Finishing'])) {
                $model->attributes = $_POST['Finishing'];
                if ($model->validate()) {
                    $sizePapers = $_POST['Finishing']['size_paper'];
                    $cateUnit = PrintPrice::model()->getSetlHasConfig($modelCate->id);
                    $printingSide = PrintPrice::model()->getSidelHasConfig($modelCate->id);
                    if ($model->save() && count($cateUnit > 0)) {
                        if ($model->allowUpdateDelete()) {
                            // Delete all row to create new update
                            FinishingPrice::model()->deleteAll('finishing_id = ' . $model->id);
                            foreach ($cateUnit as $val) {
                                foreach ($sizePapers as $paper) {
                                    if ($printingSide) {
                                        foreach ($printingSide as $side) {
                                            $this->saveRecord($modelCate->id, $val['set_id'], $paper, $model->id, $side['printing_side_id']);
                                        }
                                    } else {
                                        $this->saveRecord($modelCate->id, $val['set_id'], $paper, $model->id, 0);
                                    }
                                }
                            }
                        }
                    }
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been update');
                    $this->redirect(array('create', 'cateId' => $modelCate->id));
                } else {
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
                }
            }
            $this->render('update', array(
                'model' => $model,
                'modelCate' => $modelCate,
                'actions' => $this->listActionsCanAccess,
            ));
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionDelete($id) {
        try {
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                if (!in_array($id, $this->cannotDelete)) {
                    if ($model = $this->loadModel($id)) {
                        // Delete all table relation (Material, size_papper, print_price(if not set price), extra feature, finishing)
                        FinishingPrice::model()->deleteAll('finishing_id = ' . $id);
                        if ($model->delete()) {
                            Yii::log("Delete record " . print_r($model->attributes, true), 'info');
                        }
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
            } else {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException($e);
        }
    }
    
    public function loadModel($id) {
        //need this define for inherit model case. Form will render parent model name in control if we don't have this line
        $initMode = new Finishing();
        $model = $initMode->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionIndex($cate_id = null, $size_paper = null) 
    {        
        $model = new FinishingPrice();
        $this->singleTitle = "Finishing Price Configuration";
        if ($cate_id == null || $size_paper == null) {
            if (isset($_POST['FinishingPrice'])) {
                $model->attributes = $_POST['FinishingPrice'];
                if ($model->print_category_id != "" && ($model->size_paper_id != "")) {
                    $this->redirect(array('index', 'cate_id' => $model->print_category_id, 'size_paper' => $model->size_paper_id));
                } else {
                    if ($model->print_category_id == "") {
                       $model->addError('print_category_id', 'Print Category can not blank.');
                    }
                    if (($model->size_paper_id == "")) {
                       $model->addError('size_paper_id', 'Paper Size can not blank.');
                    }
                }
            }
            $this->render('price_step_1', array(
                'model' => $model,
            ));
        } else {
            $modelCate = PrintCategories::model()->findByPk($cate_id);
            $modelSizepaper = PrintSizePaper::model()->findByPk($size_paper);
            if (isset($_POST['PriceAll'])) {
//                Utils::dump($_POST['PriceAll']);
//                exit();
                foreach ($_POST['PriceAll'] as $key => $item) {
                    $data = explode(',', $key);
                    $cateId = trim($data[0]);
                    $sizepaper = trim($data[1]);
                    $unitId = trim($data[2]);
                    $finishingId = trim($data[3]);
                    $sideId = trim($data[4]);
                    $price = $item['price'];
                    // save db
                    $this->saveRecord($cateId, $unitId, $sizepaper, $finishingId, $sideId, $price);
                    $this->setNotifyMessage(NotificationType::Success, 'All Price has been updated');
                }
            }
            
            $this->render('price', array(
                'model' => $model,
                'modelCate' => $modelCate,
                'modelSizepaper' => $modelSizepaper,
                'actions' => $this->listActionsCanAccess,
            ));
        }
    }
    
    public function actionGenListSizePaper() {
        $rq = Yii::app()->request;
        if ($rq->isPostRequest) {
            $cate_id = $rq->getParam('cate_id');
            $model = FinishingPrice::model()->getSizePaperHasConfig($cate_id);
            $html = "";
            $html .= '<option value="">----Select size of paper----</option>';
            foreach ($model as $item) {
                if (isset($item->sizePaper)) {
                    $html .= '<option value="'. $item->size_paper_id . '">'. $item->sizePaper->name . '</option>';
                }
            }
            echo $html;
        } else {
            Yii::log("Invalid request. Please do not repeat this request again.");
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

}
