<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends MY_Controller {

    function index() {
        $a = new A();
        $a->b(function ($v) {
            return is_array($v) ? 'array' : 'not array';
        });
        $a->c();
    }
}

class A {

    var $f;
    var $v = array(
        array("p" => "p1", "q" => "q1"),
        array("p" => "p2", "q" => "q2")
    );

    function __construct() {
//        $this->f = function ($v) {
//            return $v;
//        };
    }

    function b($f) {
        $this->f = $f;
    }

    function c() {
        foreach ($this->v as $u) {
            echo is_array($u) ? 'array' : 'no';
            echo '<br>';
            echo call_user_func($this->f, $u);
        }
    }
}
