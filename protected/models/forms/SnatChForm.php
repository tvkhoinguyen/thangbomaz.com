<?php

class SnatChForm extends CFormModel {
    public $email;
    public $id;
    public function rules() {
        return array(
            array('email, id', 'required'),
            array('email', 'email')
        );
    }
}