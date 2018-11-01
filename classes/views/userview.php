<?php
require_once 'classes/views/View.php';

class UserView extends View{
	private $content;
    public function __construct($model){
    	parent::__construct($model);
    }
    public function prepLogin($store = true){
    	$str = "<form action='php/login.php'>";
    	$str .= "<input type='text' name='email' placeholder='Your email, now!'>";
    	$str .= "<input type='password' name='password' placeholder='and also your password...'>";
    	$str .= "<input type='submit' value='Go HAM'>";
        if($store){
            $this->content[] = $str;
        }
    	return $str;
    }
    public function clearContent(){
        unset($this->content);
    }
    public function output(){
        $data = $this->content;
        $str = $this->prepHead();
        foreach($data as $content){
            $str .= $content;
        }
        $str .= $this->prepEnd();
        return $str;
    }
}