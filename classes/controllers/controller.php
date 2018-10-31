<?php
/**
 * controller/Controller.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once '../models/model.php';

class Controller {
    private $model;
    private $qs;
    private $function;

    public function __construct($qs) {
        $this->qs = $qs;
        foreach ($qs as $key => $value) {
            $$key = $value;
        }
        $this->function = isset($function) ? $function : 'A';
    }
    public function doSomething() {
        switch ($this->function) {
            case 'A':   //auth
                $this->model = new User(null, null);
                $view1 = new LoginView($this->model);
                if (isset($_POST)) {
                    $this->auth($_POST);
                }
                $view1->display();
                break;
            case 'Z':   //logout
                $this->model = new User(null, null);
                $view1 = new LoginView($this->model);
                $this->logout();
                $view1->display();
                break;
            case 'C':   //city create
                $this->model = new City('DNK', null, null, null, null);   // init a model
                $view1 = new CityView($this->model);                 // init view
                if (isset($_POST)) {
                    $this->createCity($_POST);                  // activate controller
                }
                $view1->display();
                break;
            case 'L':   //lang create
                $this->model = new CountryLanguage('DNK', null, null, null); // init a model
                $view1 = new LanguageView($this->model);                     // init a view
                if (isset($_POST)) {
                    $this->createLanguage($_POST);                  // activate controller
                }
                $view1->display();
                break;
            case 'U':   //user create
                $this->model = new User(null, null); // init a model
                $view1 = new UserView($this->model);                  // init a view
                if (isset($_POST)) {
                    $this->createUser($_POST);               // activate controller
                }
                $view1->display();
                break;
            case 'Co':  //country create
                break;
        }
    }
 
    public function auth($p) {
        if (isset($p) && count($p) > 0) {
            if (!Authentication::isAuthenticated() 
                    && Model::areCookiesEnabled()
                    && isset($p['uid'])
                    && isset($p['pwd'])) {
                        Authentication::authenticate($p['uid'], $p['pwd']);
            }
            $p = array();
        }
    }

    public function createCity($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $city = City::createObject($p);  // object from array
            $city->create();         // model method to insert into db
            $p = array();
        }
    }

    public function createLanguage($p) {
        if (isset($p) && count($p) > 0) {
            $language = CountryLanguage::createObject($p);  // object from array
            $language->create();         // model method to insert into db
            $p = array();
        }
    }

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
}