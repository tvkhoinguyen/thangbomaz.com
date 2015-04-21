<?php

/*
 * DTOAN
 * SHOW LOGIN
 * 6-12-2013
 */
class JoinWidget extends CWidget
{
    public function run()
    {        
        $this->getCategory();
    }
    
    public function getCategory()
    {
        $model =  new Subscriber();

            /*if(isset($_POST['Subscriber']) ) 
            {
                $model->email = $_POST['Subscriber']['email'];
                if ( !empty($model->email)) 
                {
                    $rs = Subscriber::model()->findAll(array('condition'=>'email="'.$model->email.'"'));
                    if(count($rs)>0) 
                    {
                        foreach($rs as $subscriber) {
                            $subscriber->status = 1;
                            $subscriber->subscribed_date = date('Y-m-d H:i:s');
                            $subscriber->update(array('status','subscribed_date'));
                            if(!GroupGroupSubscriber::model()->checkExist($subscriber->id, SUBSCRIBER_GROUP_MEMBER)) 
                            {
                                GroupGroupSubscriber::model()->saveGroup($subscriber->id, SUBSCRIBER_GROUP_MEMBER);
                            } 
                        }
                    } else {
                        // $subscriber = new Subscriber();
                        $model->status = 1;
                        // $subscriber->name = $model->first_name.' '.$model->last_name;
                        // $model->email = $model->email;
                        $model->subscribed_date = date('Y-m-d H:i:s');
                        if($model->save()) 
                        {
                            GroupGroupSubscriber::model()->saveGroup($model->id, SUBSCRIBER_GROUP_MEMBER);
                        }
                    }
                } 
            }*/

            $this->render(  'subscriber_widget', array(
                'model'=>$model
            ));
    }   

    public $actionPrefix = 'requestnewletter.';
    // now is an action provider 
    public static function actions()
    {
             return array(
                'Addsubscriber'=>'application.components.actions.newletter2',
             );
    }
}


class newletter2 extends CAction
{
    public function run()
    {
        $model =  new Subscriber();
        if(isset($_POST['Subscriber']) ) 
        {
            $model->email = $_POST['Subscriber']['email'];
            // if($model->validate() ){}
            // else{
            //     $error = CActiveForm::validate($model);
            //     die( trim( json_encode(array('status1111'=>'error','data'=>$error  ))) );
            // }

            if ( !empty($model->email)) 
            {
                $rs = Subscriber::model()->findAll(array('condition'=>'email="'.$model->email.'"'));
                if(count($rs)>0) 
                {
                    foreach($rs as $subscriber) {
                        $subscriber->status = 1;
                        $subscriber->subscribed_date = date('Y-m-d H:i:s');
                        $subscriber->update(array('status','subscribed_date'));
                        if(!GroupGroupSubscriber::model()->checkExist($subscriber->id, SUBSCRIBER_GROUP_MEMBER)) 
                        {
                            GroupGroupSubscriber::model()->saveGroup($subscriber->id, SUBSCRIBER_GROUP_MEMBER);
                        } 
                    }
                    $error = CActiveForm::validate($model);
                    die( trim( json_encode(array('status'=>'error', 'data'=>$error ))) );

                } else {
                    // $subscriber = new Subscriber();
                    $model->status = 1;
                    // $subscriber->name = $model->first_name.' '.$model->last_name;
                    $model->email = $model->email;
                    $model->subscribed_date = date('Y-m-d H:i:s');
                    if($model->save()) 
                    {
                        GroupGroupSubscriber::model()->saveGroup($model->id, SUBSCRIBER_GROUP_MEMBER);
                        // $error = CActiveForm::validate($model);
                        die( trim( json_encode(array('status'=>'success', 'data'=>'load_popup' ))) );
                    }
                }
            } 
        }
        else 
        {
            $error = CActiveForm::validate($model);
            die( trim( json_encode(array('status'=>'error','data'=>$error  ))) );
        }

                /*if(isset($_POST['LoginForm']))
                {
                    $model->attributes = $_POST['LoginForm'];
                    if ($model->validate()) 
                    {
                        $link = Yii::app()->createAbsoluteUrl('member/site/myOrder');
                        SpOrders::updateCartUserId();//update lai cart UserID
                        // if (!empty($returnUrl)) {
                        //     Yii::app()->getRequest()->redirect(Yii::app()->createAbsoluteUrl($returnUrl));
                        // }

                        // if (strpos(Yii::app()->user->returnUrl, '/index.php') === false)
                        //     Yii::app()->getRequest()->redirect(Yii::app()->user->returnUrl);

                        switch (Yii::app()->user->role_id) 
                        {
                            // case ROLE_ADMIN:
                            //     Yii::app()->getRequest()->redirect(Yii::app()->createAbsoluteUrl('admin/site/login'));
                            //     break;
                            case ROLE_MEMBER:
                                $link = Yii::app()->createAbsoluteUrl('member/site/myOrder');
                                break;
                        }
                        die( trim( json_encode(array('status'=>'success', 'data'=>$link ))) );

                    }else{
                         $error = CActiveForm::validate($model);
                         die( trim( json_encode(array('status'=>'error','data'=>$error  ))) );
                    }
                }else
                {
                         $error = CActiveForm::validate($model);
                         die( trim( json_encode(array('status'=>'error','data'=>$error  ))) );
                    }
        }else{
             $error = CActiveForm::validate($model);
             die( trim( json_encode(array('status'=>'error','data'=>$error  ))) );
        }*/
    }
}