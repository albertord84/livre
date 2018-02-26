<?php

class client_status {

    const BEGINNER= 1;
    const OPEN = 2;
    const ENDED = 3;
    const PENDING = 4;
    

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
