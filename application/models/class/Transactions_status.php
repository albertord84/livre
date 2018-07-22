<?php

class transactions_status {

    const BEGINNER= 1;
    const APPROVED = 2;
    const WAIT_PHOTO = 3;
    const WAIT_ACCOUNT = 4;
    const WAIT_SING_US = 5;
    const TOPAZIO_APROVED = 6;
    const TOPAZIO_IN_ANALISYS = 7;
    const TOPAZIO_DENIED = 8;
    const REVERSE_MONEY = 9;
    const PENDING = 22;

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
