<?php
require_once 'classes/views/View.php';

class YaddaView extends View {
    private $content;
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
    public function displayWriteYadda($store = true){



        if($store){
            $this->content[] = $str;
        }
        return $str;
    }
    public function displayList($store = true){
        $str = "<form action='php/actionhandler.php' method='POST'>";
        $str .= "<input type='hidden' name='action' value='logout'>";
        $str .= "<input type='submit' value='Sign Out'>";
        $str .= "</form>";
        foreach($this->model->retrieveAll() as $yadda){
            $str .= "<div class='yadda'>";
                $str .= "<div class='yaddaitem'>";
                $str .= "<h3>";
                $str .= $yadda->getUser()->getHandle() . '#' . $yadda->getUser()->getId();
                $str .= "</h3>";
                $str .= "<p>";
                $str .= $yadda->getContent();
                $str .= "</p>";
                $str .= "</div>";
            $str .= "</div>";
        }
        if($store){
            $this->content[] = $str;
        }
        return $str;
    }
    public function display(){
        $str = $this->prepHead();
        foreach($this->content as $content){
            $str .= $content;
        }
        $str .= $this->prepEnd();
        return $str;
        /*$str = "<form action='php/actionhandler.php' method='POST'>";
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
        echo '<br>';*/
    }
}