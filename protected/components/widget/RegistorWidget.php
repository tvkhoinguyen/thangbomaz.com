<?php
class RegistorWidget extends CWidget
{
    public function run()
    {        
        $this->getCategory();
    }
    
    public function getCategory()
    {
        $model = new Member('widget_create_member');
        $this->render( 'registor_widget' ,array(
                'model'=>$model
            ));
    } 

    public $actionPrefix = 'requestnewletter.';
    // now is an action provider 
    public static function actions()
    {
             return array(
                'Addsubscriber'=>'application.components.actions.newletter',
             );
     }   
}

class newletter extends CAction{
    public function run()
    {
        $model = new Member('widget_create_member');
        if ( Yii::app()->request->isPostRequest && !isset($_POST['ajax']) ) 
        {
                if(isset($_POST['Member']))
                {
                    $model->attributes = $_POST['Member'];
                    $model->role_id = ROLE_MEMBER;
                    $model->application_id = FE;
                    $model->status = STATUS_ACTIVE;
                    $model->created_date = date('Y-m-d H:i:s');
                    $model->full_name = $model->first_name . ' ' . $model->last_name;
                    $model->password_hash = md5($model->temp_password);
                    if($model->validate())
                    {
                        if($model->save())
                        {
                            //send mail cho user va admin
                            SendEmail::registerSucceedMailToUser($model);
                            SendEmail::registerSucceedMailToAdmin($model);

                            //subcribe_newletter
                            if(isset($_POST['subcribe_newletter']) && $_POST['subcribe_newletter']=='subcribe_newletter' )
                            {
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
                                        $subscriber = new Subscriber();
                                        $subscriber->status = 1;
                                        $subscriber->name = $model->first_name.' '.$model->last_name;
                                        $subscriber->email = $model->email;
                                        $subscriber->subscribed_date = date('Y-m-d H:i:s');
                                        if($subscriber->save()) {
                                            GroupGroupSubscriber::model()->saveGroup($subscriber->id, SUBSCRIBER_GROUP_MEMBER);
                                        }
                                    }
                                } 
                            }

                            //auto login
                            $loginform = new LoginForm();
                            $loginform->login_by = 'email'; //login by username or email.
                            // $returnUrl = '';
                            // if (isset($_GET['returnUrl'])) 
                            // {
                            //     $returnUrl = urldecode($_GET['returnUrl']);
                            // }
                            $loginform->email = $model->email;
                            $loginform->password = $model->temp_password;
                            if ($loginform->validate()) 
                            {
                                $link = Yii::app()->createAbsoluteUrl('member/site/myProfile');
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
                                        $link = Yii::app()->createAbsoluteUrl('member/site/myProfile');
                                        break;
                                }
                                die( trim(json_encode(array('status'=>'success','data'=>$link))) );
                            } 
                            die( trim(json_encode(array('status'=>'success','data'=>''))) );
                        }              
                    }else{
                         $error = CActiveForm::validate($model);
                         die( trim( json_encode(array('status'=>'error','data'=>$error  ))) );
                    }
                }
        }else{
             $error = CActiveForm::validate($model);
             die( trim(  json_encode(array('status'=>'error','data'=>$error  ))) );
        }
    }
}