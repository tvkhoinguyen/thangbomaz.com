<?php
/*
 * @author	Lam Huynh
 */
class PaypalController extends FrontController
{

    public function actionPurchase()
    {
        if (isset($_GET['order_id']) && isset(Yii::app()->session['order_ss_id'])) 
        {
            $order_id = $_GET['order_id'];
            $mOrder = SpOrders::model()->findByPk(base64_decode($order_id));
            $aItems[] = array(
                'item_name' => 'Payment order: ' . $mOrder->order_no,
                'amount' => number_format($mOrder->total, 2),
                'quantity' => '1',
                'item_number' => $mOrder->order_no,
            );

            $payment_type = Yii::app()->params['paypalMode'];

            $return_url = Yii::app()->createAbsoluteUrl('paypal/return', array(
                'order_id' => $_GET['order_id'],
                'user_tmp_id'=> $_GET['user_tmp_id'],
                'payment_type' => $payment_type
            ));
            $cancel_url = Yii::app()->createAbsoluteUrl('paypal/cancel', array(
                'order_id' => $_GET['order_id'],
                'user_tmp_id'=> $_GET['user_tmp_id'],
                'payment_type' => $payment_type
            ));
            $notify_url = Yii::app()->createAbsoluteUrl('paypal/notify', array(
                'order_id' => $_GET['order_id'],
                'user_tmp_id'=> $_GET['user_tmp_id'],
                'payment_type' => $payment_type
            ));

            if (isset(Yii::app()->session['order_ss_id'])) 
            {
                Yii::app()->session['order_ss_id'] = '';
                unset(Yii::app()->session['order_ss_id']);
            }

            Paypal::send($aItems, $return_url, $cancel_url, $notify_url);
        } else {
            $this->redirect(Yii::app()->createAbsoluteUrl('site/myCart'));
        }

    }

    public function actionNotify()
    {
        if (!Paypal::isValid()) return;
        // $file1 = Yii::app()->basePath.'/paypal_test.txt';
        // file_put_contents($file1, var_export($_POST, true));

        $order_id = $_GET['order_id'];
        $user_tmp_id = $_GET['user_tmp_id'];
        $mOrder = SpOrders::model()->findByPk(base64_decode($order_id));
        if ($mOrder) {

            $hasErrors = false;
            // Check payment status
            if ($_POST['payment_status'] != 'Completed')
                $hasErrors = true;
            // Check seller e-mail
            if ($_POST['receiver_email'] != Yii::app()->params['paypalBusinessEmail'])
                $hasErrors = true;

            if ($hasErrors == false) //SUCCESS
            {

                $mOrder->status = ORDER_STATUS_ORDERED;
                $mOrder->update(array('status')); // update order status

                $transaction = new SpOrderTransactions();
                $transaction->order_id = $mOrder->id;
                $transaction->transaction_id = $_POST['txn_id'];
                $transaction->transaction_data = json_encode($_POST);
                $transaction->created_date = date('Y-m-d H:i:s');
                $transaction->save();

                //Save address to address book
                $items = SpOrders::getItemsInTableInvoice($mOrder);
                // $items = SpOrders::getItemsInTable($mOrder);
                SendEmail::sendNotifyOrderMemberPaypal($mOrder, $items);
                SendEmail::sendNotifyOrderAdminPaypal($mOrder, $items);
                
                /*if(!empty($user_tmp_id))
                {
                    $user2 = Users2::model()->findByPk($user_tmp_id);
                    $user = new Users;
                    if(!empty($user2))
                    {
                        $user->email = $user2->email;
                        $user->first_name = $user2->first_name;
                        $user->last_name = $user2->last_name;
                        $user->contact_first_name = $user2->contact_first_name;
                        $user->contact_last_name = $user2->contact_last_name;
                        $user->status = STATUS_ACTIVE;
                        $user->role_id = ROLE_MEMBER;
                        $user->application_id = FE;
                        // $user->agreeTermOfUse = true;
                        $user->area_code_id = $user2->area_code_id;
                        $user->phone = $user2->phone;
                        $user->company = $user2->company;
                        $user->city = $user2->city;
                        $user->state = $user2->state;
                        $user->postal_code = $user2->postal_code;
                        $user->address1 = $user2->address1;
                        $user->address2 = $user2->address2;
                        $user->temp_password = $user2->temp_password;
                        $user->password_confirm = $user2->password_confirm;
                        $user->password_hash = $user2->password_hash;
                        $user->full_name = $user2->full_name;
                        $user->created_date = $user2->created_date;

                        $user->save(false);
                        $mOrder->user_id = $user->id;
                        $mOrder->update(array('user_id'));
                        SendEmail::registerSucceedMailToUser($user);
                        SendEmail::registerSucceedMailToAdmin($user);
                        $user2->delete();
                    }
                }*/
                Yii::app()->session['order_ss_id']='';
                unset(Yii::app()->session['order_ss_id']);
            } else {
                Yii::app()->session['order_ss_id']='';
                unset(Yii::app()->session['order_ss_id']);
            }
        }else{
                Yii::app()->session['order_ss_id']='';
                unset(Yii::app()->session['order_ss_id']);
        }
        $this->writeLog($_POST);
    }


    public function actionReturn()
    {
        try {
            if (isset($_GET['order_id']) && $_GET['order_id']){

                if (isset(Yii::app()->session['order_ss_id'])) {
                    Yii::app()->session['order_ss_id']='';
                    unset(Yii::app()->session['order_ss_id']);
                }
                $this->setNotifyMessage(MessageHelper::SUCCESS, Yii::t('translation', "Your order is successful and is being processed. An email with this order's information has been sent to your inbox."));
                if(Yii::app()->user->id) {
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/site/myOrder'));
                } else {
                    $this->redirect(Yii::app()->createAbsoluteUrl('printSolutions/index', array('slug' => 'all')));
                }
            } else {
                $this->redirect(Yii::app()->createAbsoluteUrl('site/myCart'));
            }
        } catch (Exception $e) {
            // Yii::log("Exception " . print_r($e, true), 'error');
            // throw new CHttpException(400, $e->getMessage());
        }
    }

    public function actionCancel()
    {
        if (isset(Yii::app()->session['order_ss_id'])) {
            $model = SpOrders::model()->findByPk(Yii::app()->session['order_ss_id']);
            $model->status = ORDER_STATUS_CANCELLED;
            $model->update();
            Yii::app()->session['order_ss_id']='';
            unset(Yii::app()->session['order_ss_id']);
        }

        if (isset($_GET['order_id']) && $_GET['order_id']) {
            $this->setNotifyMessage(MessageHelper::SUCCESS, Yii::t('translation', 'You have cancelled your payment. Try again if you want.'));
            if(Yii::app()->user->id) {
                $this->redirect(Yii::app()->createAbsoluteUrl('member/site/myOrder'));
            } else {
                $this->redirect(Yii::app()->createAbsoluteUrl('printSolutions/index', array('slug' => 'all')));
            }
        } else {
            $this->redirect(Yii::app()->createAbsoluteUrl('site/myCart'));
        }
    }

    /*
     * Write notify data to log file
     */
    public function writeLog($data)
    {
        $file = Yii::app()->basePath . '/payment_log.txt';
        $s = json_encode($data) . "--{{SEPERATOR}}--";
        file_put_contents($file, $s, FILE_APPEND);
    }

    /*
     * View paypal log
     */
    public function actionLog()
    {
        $file = Yii::app()->basePath . '/payment_log.txt';
        if (!is_file($file)) {
            die('log file not exists');
        }
        $ss = array_reverse(array_filter(explode("--{{SEPERATOR}}--", trim(file_get_contents($file)))));
        $items = array_map('json_decode', $ss);
        $this->render('log', array('items' => $items));
    }


}