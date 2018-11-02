<?php
//require_once 'model.php';

abstract class View {

    protected $model;
    private $title;
    public function __construct($model) {
        $this->model = $model;
    }
    public function prepHead($metas = false, $links = false){
    	$str = "<!DOCTYPE html>";
    	$str .= "<html><head>";
    	$str .= "<title>";
    	$str .= $this->title;
    	$str .= "</title>";
    	$str .= "</head><body>";
    	return $str;
    }
    public function setTitle($title = 'undefined'){
    	$this->title = $title;
    }
    public function getTitle(){
    	return $this->title;
    }
    public function prepEnd($scripts = false){
    	$str = "";
    	if($scripts){
    		foreach($scripts as $script){
    			$str .= $script;
    		}
    	}
    	$str .= "</body></html>";
    	return $str;
    }
}