<?php
require_once(rootPath . 'classes/views/View.php');

class UserView extends View{
	private $content;
    public function __construct($model){
    	parent::__construct($model);
    }
    public function prepLogin($store = true){
        $str = "<p>Don't have a user yet? <a href='?page=create-user'>create user</a></p>";
        $str .= "<form action='php/actionhandler.php' method='POST'>";
        $str .= "<input type='hidden' name='action' value='userLogin'>";
    	$str .= "<input type='text' name='user[email]' placeholder='Your email, now!'>";
    	$str .= "<input type='password' name='user[password]' placeholder='and also your password...'>";
    	$str .= "<input type='submit' value='Go HAM'>";
        $str .= "</form>";
        if($store){
            $this->content[] = $str;
        }
    	return $str;
    }
    public function prepNewUser($store = true){
        $str = "<p>Already have a user? <a href='?page=login'>login here</a></p>";
        $str .= "<form action='php/actionhandler.php' method='POST'>";
        $str .= "<input type='hidden' name='action' value='userCreate'>";
        $str .= "<input type='text' name='user[name]' placeholder='Name'>";
        $str .= "<input type='text' name='user[handle]' placeholder='Username'>";
        $str .= "<input type='text' name='user[email]' placeholder='Email'>";
        $str .= "<input type='password' name='user[password]' placeholder='Password'>";
        $str .= "<input type='submit' value='Submit To Us'>";
        $str .= "</form>";
        if($store){
            $this->content[] = $str;
        }
        return $str;
    }
    public function clearContent(){
        unset($this->content);
    }
    public function output(){
        $str = $this->prepHead();
        foreach($this->content as $content){
            $str .= $content;
        }
        $str .= $this->prepEnd();
        return $str;
    }
}