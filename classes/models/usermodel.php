<?php
require_once('classes/models/model.php');
class UserModel extends Model {
    private $con;
    private $id, $email, $name, $pwd, $handle, $status, $permission;
    public function __construct($table = "users") {
        parent::__construct();
        $this->con = $this->connect();
        $this->table = $table;
    }

    public function getId(){
        return $this->id;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getName(){
        return $this->name;
    }
    public function getPwd(){
        return $this->pwd;
    }
    public function getHandle(){
        return $this->handle;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getPermission(){
        return $this->permission;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setPwd($pwd){
        $this->pwd = $pwd;
    }
    public function setHandle($handle){
        $this->handle = $handle;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function setPermission($permission){
        $this->permission = $permission;
    }

    public function create(){
        $stmt = $this->con->prepare("INSERT INTO $this->table (name, email, password, handle, status, permission) VALUES (:name, :email, :pwd, :handle, :status, :permission)");
        $stmt->execute(array(
            ':email' => $this->email,
            ':name' => $this->name,
            ':pwd' => password_hash($this->pwd, PASSWORD_DEFAULT),
            ':handle' => $this->handle,
            ':status' => $this->status,
            ':permission' => $this->permission
        ));
    }
    public function update(){
        $stmt = $this->con->prepare("UPDATE $this->table SET name = :name, email = :email, password = :pwd, handle = :handle, status = :status, permission = :permission WHERE id = :id");
        $stmt->execute(array(
            ':id' => $this->id,
            ':email' => $this->email,
            ':name' => $this->name,
            ':pwd' => password_hash($this->pwd, PASSWORD_DEFAULT),
            ':handle' => $this->handle,
            ':status' => $this->status,
            ':permission' => $this->permission
        ));
    }
    public function delete(){
        $stmt = $this->con->prepare("DELETE * FROM $this->table WHERE id = :id");
        $stmt->execute(array(':id' => $this->id));
    }
    public function retrieve(){
        $search = isset($this->id) ? array('col' => 'id', 'value' => $this->id) : array('col' => 'email', 'value' => $this->email);
        $col = $search['col'];
        $stmt = $this->con->prepare("SELECT id, email, name, password, handle, status, permission FROM $this->table WHERE $col = :val");
        $stmt->execute(array(
            ':val' => $search['value']
        ));
        $user = $stmt->fetchObject();
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->pwd = $user->password;
        $this->handle = $user->handle;
        $this->status = $user->status;
        $this->permission = $user->permission;
    }
}
?>