<?php

namespace labalityowo\kcp;

class Utils{

    public static function unsigned_shift_right($value, $steps) {
        if ($steps == 0) {
            return $value;
        }
        return ($value >> $steps) & ~(1 << (8 * PHP_INT_SIZE - 1) >> ($steps - 1));
    }
}