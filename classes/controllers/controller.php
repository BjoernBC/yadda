<?php
class Controller {
    private $model;
    public function __construct() {

    }
    public function drawPage($page){
        if($this->auth($_POST)){

        }
        switch ($page){
            case 'login':
                require_once(rootPath . 'classes/models/usermodel.php');
                require_once(rootPath . 'classes/views/userview.php');
                $model = new UserModel();
                $view = new UserView($model);
                $view->prepLogin();
                return $view->output();
                break;

            case 'yadda':
                require_once(rootPath . 'classes/models/yaddamodel.php');
                require_once(rootPath . 'classes/views/yaddaview.php');
                $model = new YaddaModel();
                $view = new YaddaView($model);
                $view->prepLogin();
                return $view->output();
                break;
            
            default:
                # code...
                break;
        }
    }
    public function auth($p){
        if (isset($p['user']) && count($p['user']) > 0){
            if (!Authentication::isAuthenticated() 
                    && Model::areCookiesEnabled()
                    && isset($p['user']['id'])
                    && isset($p['user']['password'])) {
                        return Authentication::authenticate($p['user']['id'], $p['user']['password']);
            }
        }
    }
    public function userLogin(){
        require_once(rootPath . 'classes/models/usermodel.php');
        $this->auth($_POST);
    }
    public function userCreate(){

    }
    /*
    public function createUser($p) {
        if (isset($p) && count($p) > 0) {
            $user = User::createObject($p);  // object from array
            $user->create();         // model method to insert into db
            $p = array();
        }
    }
    
    public function logout() {
        Authentication::Logout();
    }
    */
}