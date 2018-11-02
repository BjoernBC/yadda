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

            case 'create-user':
                require_once(rootPath . 'classes/models/usermodel.php');
                require_once(rootPath . 'classes/views/userview.php');
                $model = new UserModel();
                $view = new UserView($model);
                $view->prepNewUser();
                return $view->output();
                break;

            case 'yadda':
                require_once(rootPath . 'classes/models/yaddamodel.php');
                require_once(rootPath . 'classes/views/yaddaview.php');
                $model = new YaddaModel();
                $model->setId(3);
                $model->retrieve();
                $view = new YaddaView($model);
                $view->displayAuthor().$view->displayContent().$view->displayDate();
                return $view->display();
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
    public function userCreate($p){
        require_once(rootPath . 'classes/models/usermodel.php');
        if(isset($p['user'])){
            $user = $p['user'];
        }
        $model = new userModel();
        $model->setName($user['name']);
        $model->setEmail($user['email']);
        $model->setHandle($user['handle']);
        $model->setPwd($user['password']);
        $model->create();
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