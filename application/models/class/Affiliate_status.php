<?php

class affiliate_status {

    const BEGINNER= 1;
    const ACTIVE = 2;
    const DELETED = 3;
    const DONT_DISTURB= 4;

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
