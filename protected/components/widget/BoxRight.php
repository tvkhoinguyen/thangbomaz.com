<?php

/*
 * DTOAN
 * SHOW LOGIN
 * 6-12-2013
 */
class BoxRight extends CWidget
{
    public function run()
    {        
        $this->getCategory();
    }
    
    public function getCategory()
    {
            // $model = new LoginForm();
            // $model->login_by = 'email';

            $this->render(  'boxright_view', array(
                // 'model'=>$model
            ));
    }   

    // public $actionPrefix = 'requestnewletter.';
    // // now is an action provider 
    // public static function actions()
    // {
    //          return array(
    //             'Addsubscriber'=>'application.components.actions.newletter1',
    //          );
    // }
}


/*class newletter1 extends CAction
{
    public function run()
    {
        $model = new LoginForm();
        $model->login_by = 'email';
        if ( Yii::app()->request->isPostRequest ) 
        {
                if(isset($_POST['LoginForm']))
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
        }
    }
}*/