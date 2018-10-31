<?php
//require_once 'model.php';

abstract class View {

    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }
    public function output() {

    }
}