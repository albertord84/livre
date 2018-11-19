<?php

class Watchdog_type {

    const INSERT = 1;
    const DELETE = 2;
    const UPDATE = 3;
    const SOLICITED_SIGNATURE = 4;
    const REFUND = 5;
    const LOGIN = 6;
    const LOGOUT = 7;
    const SOLICITED_ACCOUNT = 8;
    const APPROVE = 9;
    const SOLICITED_PHOTO = 10;
    const SET_PENDING = 11;
    const ENDING = 12;
    const REFUND_USER = 13;
    
    static public function Defines($const) {
        $cls = new ReflectionClass(__CLASS__);
        foreach ($cls->getConstants() as $key => $value) {
            if ($value == $const) {
                return true;
            }
        }
        return false;
    }

}
