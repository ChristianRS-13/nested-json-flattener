<?php

/*
 * The MIT License
 *
 * Copyright 2016 tonirilix.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace NestedJsonFlattener\Utils;

use stdClass;

/**
 * Description of DataConverter
 *
 * @author tonirilix
 */
class Dataconverter {

    public function __construct() {
        
    }

    /**
     * This function works as same as json_decode(json_encode($arr), false). 
     * It was taken from http://stackoverflow.com/a/31652810/3442878
     * @param array $arr
     * @return object
     */
    public function arrayToObject(array $arr) {
        $flat = array_keys($arr) === range(0, count($arr) - 1);
        $out = $flat ? [] : new stdClass();

        foreach ($arr as $key => $value) {
            $temp = is_array($value) ? $this->arrayToObject($value) : $value;

            if ($flat) {
                $out[] = $temp;
            } else {
                $out->{$key} = $temp;
            }
        }

        return $out;
    }

}