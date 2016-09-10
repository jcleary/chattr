<?php
require_once '../lib/app.php';

class IndexController extends Rest {

    public function get() {
        include '../partials/_main_page.php';
    }
}

new IndexController();

