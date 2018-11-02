<?php
require_once 'classes/views/View.php';

class YaddaView extends View {
    private $str;
    public function __construct($model) {
    	parent::__construct($model);
    }

    public function displayAuthor(){
        $this->name = $this->model->getUser()->getName();
        $this->auth = "$".$this->model->getUser()->getHandle().'#'
        .$this->model->getUser()->getId();
    }
    public function displayContent(){
    	$this->content = $this->model->getContent();
    }
    public function displayDate(){
    	$this->date = $this->model->getEdited();
    }
    public function displayReplyNo(){
    	
    }
    public function displayReplies(){
    	
    }
    public function displayScore(){
    	
    }
    public function display(){
        echo $this->name;
        echo '<br>';
    	echo $this->auth;
        echo '<br>';
        echo $this->content;
        echo '<br>';
        echo $this->date;
        echo '<br>';
    }
}