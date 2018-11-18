<?php

class payment_manager {

    const DEFAULT_NAME= 0;
    const IUGU = 1;
    const BRASPAG = 2;
    const NAME_IUGU = 'IUGU';
    const NAME_BRASPAG = 'BRASPAG';
    

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
