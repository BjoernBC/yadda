<?php
require_once 'classes/views/View.php';

class YaddaView extends View {

    public function __construct($model) {
    	parent::__construct($model);
    }

    private function displayAuthor(){
    	$str = "<form action='php/actionhandler.php' method='POST'>";
        $str .= "<input type='hidden' name='action' value='userLogin'>";
        $str .= "<input type='text' name='email' placeholder='Your email, now!'>";
        $str .= "<input type='password' name='password' placeholder='and also your password...'>";
        $str .= "<input type='submit' value='Go HAM'>";
        $str .= "</form>";
        if($store){
            $this->content[] = $str;
        }
        return $str;
    }
    private function displayContent(){
    	
    }
    private function displayDate(){
    	
    }
    private function displayReplyNo(){
    	
    }
    private function displayReplies(){
    	
    }
    private function displayScore(){
    	
    }
    public function display(){
    	
    }
}