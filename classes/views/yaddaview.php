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
    public function displayList(){
        $str = $this->prepHead();
        foreach($this->model->retrieveAll() as $yadda){
            $str .= "<div class='yadda'>";
                $str .= "<div class='yaddaitem'>";
                $str .= "<h3>";
                $str .= $yada->getUser()->getHandle() . '#' . $yada->getUser()->getId();
                $str .= "</h3>";
                $str .= "</div>";
            $str .= "</div>";
        }
        $str .= $this->prepEnd();
        return $str;
    }
    public function display(){
        $str = "<form action='php/actionhandler.php' method='POST'>";
        $str .= "<input type='hidden' name='action' value='logout'>";
        $str .= "<input type='submit' value='Sign Out'>";
        $str .= "</form>";
        echo $str;
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