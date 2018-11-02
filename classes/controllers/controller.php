<?php
require_once(rootPath . 'classes/Authentication.php');
class Controller {
    private $model;
    public function __construct() {

    }
    public function drawPage($page){
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
        //print_r($p);
    require_once(rootPath . 'classes/models/model.php');
        //print_r($p);
        if (isset($p['user']) && count($p['user']) > 0){
            if (!Authentication::isAuthenticated() && Model::areCookiesEnabled() && isset($p['user']['email']) && isset($p['user']['password'])) {
                Authentication::authenticate($p['user']['email'], $p['user']['password']);
                if(Authentication::isAuthenticated()){
                    echo "success";
                }
            }
        }
    }
    public function userCreate(){
        require_once(rootPath . 'classes/models/usermodel.php');
        $model = new userModel();
    }
    /*
    public function createUser($p) {
        if (isset($p) && count($p) > 0) {
            $user = User::createObject($p);  // object from array
            $user->create();         // model method to insert into db
            $p = array();
        }
    }
    */
    public function logout(){
        Authentication::Logout();
    }
}