<?php
/**
* Author: Huu Thoa
* check out order
* created date: 25/11/2014 
*/

class CheckoutController extends FrontController
{
    public function actionIndex() {
        if (isset(Yii::app()->session['order_ss_id'])) {
            $this->pageTitle = 'Checkout - ' . Yii::app()->setting->getItem('defaultPageTitle');
            $order = SpOrders::model()->findByPk(Yii::app()->session['order_ss_id']);
            $member_id = Yii::app()->user->id;
            if ($member_id) {
                $user = Users::model()->findByPk($member_id);
                $billing_model = SpBillingAddress::model()->findByPk($member_id);
                $billing_model->contact_first_name = $user->first_name;
                $billing_model->contact_last_name = $user->last_name;
            } else {
                $billing_model = new SpBillingAddress('checkoutFE2');
                $billing_model->area_code_id = DEFAULT_COUNTRY_ID;
            }

            $shipping_model = new SpShippingAddress('create_FE');
            $shipping_model->area_code_id = DEFAULT_COUNTRY_ID;
            if (Yii::app()->request->isPostRequest) { 
                $billing_model->attributes = $_POST['SpBillingAddress'];
                $order->billing_address = json_encode($_POST['SpBillingAddress']);
                if (!isset($_POST['new_shipping_address'])) {
                    $ship_v = true;
                } else {
                    $shipping_model->attributes = $_POST['SpShippingAddress'];
                    $ship_v = $shipping_model->validate();
                }
                $bill_v = $billing_model->validate();
                if ($bill_v && $ship_v) {                    
                    if (isset($_POST['create_account']) && $_POST['create_account'] == 'create_account' ) { // create new member
                        $user = Users::findByEmail($_POST['SpBillingAddress']['email']);
                        if (!empty($user)) {
                            $user_tmp_id = '';
                        } else {
                            $user_tmp_id = $this->registerMember();
                        }
                    } else{
                        $user_tmp_id = '';
                    }    
                    $order->user_name = $_POST['SpBillingAddress']['contact_first_name'] . ' ' . $_POST['SpBillingAddress']['contact_last_name'];
                    if (isset($_POST['new_shipping_address'])) {
                        $order->shipping_address = json_encode($_POST['SpShippingAddress']);                        
                    } else {
                        $order->shipping_address = $order->billing_address;                            
                    }     
                    
                    if ($_POST['SpOrder']['method'] == ORDER_OFFLINE) {
                        $order->status = ORDER_STATUS_PENDING;
                        $order->reference_number = $_POST['SpOrder']['reference_number'];
                        $order->method = ORDER_OFFLINE;
                        $order->update(array(
                            'billing_address',
                            'shipping_address',                    
                            'user_name',
                            'status',
                            'method',
                            'reference_number'
                        ));
                        $items = SpOrders::model()->getItemsInTable($order);
                        SendEmail::sendNotifyOrderMemberPaypal($order, $items);
                        SendEmail::sendNotifyOrderAdminPaypal($order, $items);
                        unset(Yii::app()->session['order_ss_id']);
                        MessageHelper::setMessage(MessageHelper::SUCCESS, Yii::t('translation', 'Your order is on processing. Please check email for the completed payment.'));
                        if (isset(Yii::app()->user->id)) {
                            $this->redirect(Yii::app()->createAbsoluteUrl('member/site/myOrder'));
                        } else {
                            $this->redirect(Yii::app()->createAbsoluteUrl('printSolutions/index', array('slug' => 'all')));
                        }
                    } else {
                        $order->method = ORDER_ONLINE;
                        $order->update(array(
                            'billing_address',
                            'shipping_address',                    
                            'user_name',
                            'method'
                        )); // update billing_address, shipping_address, shipping fee
                        $this->redirect(Yii::app()->createAbsoluteUrl('paypal/purchase', array('order_id' => base64_encode(Yii::app()->session['order_ss_id']), 'user_tmp_id'=>$user_tmp_id   ))); 
                    }
                } 
            }

            if (!empty($order->billing_address)) {
                $billing_model->attributes = json_decode($order->billing_address, true);
            }

            if (!empty($order->shipping_address)) {
                $shipping_model->attributes = json_decode($order->shipping_address, true);
            }

            $this->render('index', array(
                'order' => $order,
                'total' => $total,
                'billing_model' => $billing_model,
                'shipping_model' => $shipping_model
            ));
        } else {
            $this->redirect(Yii::app()->createAbsoluteUrl('site/myCart'));
        }

    }

    public function registerMember() {
        $model = new Users();
        if (isset($_POST['SpBillingAddress'])) {
            $model->email = $_POST['SpBillingAddress']['email'];
            $model->first_name = $_POST['SpBillingAddress']['contact_first_name']; //$model->contact_first_name;
            $model->last_name = $_POST['SpBillingAddress']['contact_last_name']; //$model->contact_last_name;
            $model->status = STATUS_ACTIVE;
            $model->role_id = ROLE_MEMBER;
            $model->application_id = FE;
            // $model->agreeTermOfUse = true;
            $model->address1 = $_POST['SpBillingAddress']['address1'];
            $model->address2 = $_POST['SpBillingAddress']['address2'];
            $model->postal_code = $_POST['SpBillingAddress']['postal_code'];
            $model->area_code_id = $_POST['SpBillingAddress']['area_code_id']; //Singapore
            $model->city = $_POST['SpBillingAddress']['city'];
            $model->temp_password = StringHelper::getRandomString(4, 'uppercase').StringHelper::getRandomString(4, 'number').StringHelper::getRandomString(4, 'uppercase');
            $model->password_confirm = $model->temp_password;
            $model->password_hash = md5($model->temp_password);
            $model->full_name = $model->first_name . ' ' . $model->last_name;
            $model->created_date = date('Y-m-d H:i:s');
            $model->save(false);
            SendEmail::registerSucceedMailToUser($model);
            return $model->id;
        }
        return '';
    }

    public function actionShippingFee() {
        $this->layout = 'ajax';
        if (Yii::app()->request->isPostRequest) {
            $order = SpOrders::model()->findByPk(Yii::app()->session['order_ss_id']);
            $shipping_fee = SpShippingFee::getShippingFee($_POST['country_id']);
            $order->shipping_fee =  $shipping_fee;
            $order->update(array('shipping_fee'));
            SpOrders::updateOrder($order->id);
            if (isset(Yii::app()->session['order_ss_id'])) {
                $order = SpOrders::model()->findByPk(Yii::app()->session['order_ss_id']);
                $this->renderPartial('_cart_summary',
                    array('order'=>$order) 
                );
            }
        } else {
            Yii::log("Invalid request. Please do not repeat this request again.");
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionRemoveFee() {
        $this->layout = 'ajax';
        if (Yii::app()->request->isPostRequest) {
            $order = SpOrders::model()->findByPk(Yii::app()->session['order_ss_id']);
            $shipping_fee = 0;
            $order->shipping_fee =  $shipping_fee;
            $order->update(array('shipping_fee'));
            SpOrders::updateOrder($order->id);
            if (isset(Yii::app()->session['order_ss_id'])) {
                $order = SpOrders::model()->findByPk(Yii::app()->session['order_ss_id']);
                $this->renderPartial('_cart_summary',
                    array('order'=>$order) 
                );
            }
        } else {
            Yii::log("Invalid request. Please do not repeat this request again.");
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
}