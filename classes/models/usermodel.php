<?php
require_once(rootPath . 'classes/models/model.php');
class UserModel extends Model {
    private $con;
    private $id, $email, $name, $pwd, $handle, $status, $permission, $yaddas = array();
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
        $stmt = $this->con->prepare("SELECT * FROM $this->table WHERE email = :email");
        $stmt->execute(array(
            ':email' => $this->email
        ));
        if($stmt->rowCount() == 0){
            $stmt = $this->con->prepare("INSERT INTO $this->table (name, email, password, handle, status, permission) VALUES (:name, :email, :pwd, :handle, :status, :permission)");
            $stmt->execute(array(
                ':email' => $this->email,
                ':name' => $this->name,
                ':pwd' => password_hash($this->pwd, PASSWORD_DEFAULT),
                ':handle' => $this->handle,
                ':status' => 1,
                ':permission' => 0
            ));
        }
    }
    public function update(){
        $stmt = $this->con->prepare("SELECT password FROM $this->table WHERE id = :id");
        $stmt->execute(array(
            ':id' => $this->id
        ));
        $oldPwd = $stmt->fetchObject();
        if($this->pwd !== $oldPwd->password){
            $this->pwd = password_hash($this->pwd, PASSWORD_DEFAULT);
        }
        $stmt = $this->con->prepare("UPDATE $this->table SET name = :name, email = :email, password = :pwd, handle = :handle, status = :status, permission = :permission WHERE id = :id");
        $stmt->execute(array(
            ':id' => $this->id,
            ':email' => $this->email,
            ':name' => $this->name,
            ':pwd' => $this->pwd,
            ':handle' => $this->handle,
            ':status' => $this->status,
            ':permission' => $this->permission
        ));
    }
    public function delete(){
        if(isset($this->id)){
            $search = array('col' => 'id', 'value' => $this->id);
        }
        else if(isset($this->email)){
            $search = array('col' => 'email', 'value' => $this->email);
        }
        else{
            $search = false;
        }
        if($search){
            $stmt = $this->con->prepare("DELETE * FROM $this->table WHERE id = :id");
            $stmt->execute(array(':id' => $this->id));
        }
    }
    public function retrieve(){
        if(isset($this->id)){
            $search = array('col' => 'id', 'value' => $this->id);
        }
        else if(isset($this->email)){
            $search = array('col' => 'email', 'value' => $this->email);
        }
        else{
            $search = false;
        }
        if($search){
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
    public function retrieveAll(){
        $sql = "SELECT id FROM $this->table";
        $arr = array(); 
        foreach($this->con->query($sql) as $row){
            $user = new userModel();
            $user->setId($row['id']);
            $user->retrieve();
            $arr[] = $user;
        }
        return $arr;
    }
}
?>