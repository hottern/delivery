<?php
/**
 * Created by PhpStorm.
 * User: hottern
 * Date: 02.02.14
 * Time: 11:43
 */
class User extends CActiveRecord
{

    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }

    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }
}