<?php

class transactions_status {

    const BEGINNER= 1;
    const PENDING = 22;
    const APPROVED = 3;
    const TRANSFERRED = 4;
    const WRONG_TRANSFERRED = 5;
    const DENIED = 6;
    

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
