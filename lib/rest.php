<?php

abstract class Rest {

    public function __construct() {
        $this->process();
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->post();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->get();
        }
    }

    public function get() { }

    public function post() { }
}


