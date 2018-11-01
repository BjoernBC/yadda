<?php 
require_once('classes/models/model.php');
class YaddaModel extends Model {
    private $con;
    private $id, $content, $created, $edited, $userid;
    public function __construct($table = "yadda") {
        parent::__construct();
        $this->con = $this->connect();
        $this->table = $table;
    }

    public function getId(){
    	return $this->id;
    }
    public function getCreated(){
    	return $this->created;
    }
    public function getEdited(){
    	return $this->edited;
    }
    public function getUserid(){
    	return $this->userid;
    }

    public function setId($id){
    	$this->id = $id;
    }
    public function setEdited($edited){
    	$this->edited = $edited;
    }
    public function setUserid($userid){
    	$this->userid = $userid;
    }
    public function setId($id){
    	$this->id = $id;
    }

    public function create(){
        $stmt = $this->con->prepare("INSERT INTO $this->table (content, created, userid) VALUES (:content, :created, :userid)");
        $stmt->execute(array(
            ':content' => $this->content,
            ':created' => $this->created,
            ':userid' => $this->userid
        ));
    }
    public function update(){
        $stmt = $this->con->prepare("UPDATE $this->table SET content = :content, created = :edited, userid = :userid WHERE id = :id");
        $stmt->execute(array(
            ':id' => $this->id,
            ':content' => $this->content,
            ':created' => $this->edited,
            ':userid' => $this->userid
        ));
    }
    public function delete(){
        $stmt = $this->con->prepare("DELETE * FROM $this->table WHERE id = :id");
        $stmt->execute(array(':id' => $this->id));
    }


    public function retrieve(){
        if(isset($this->id)){
            $search = array('col' => 'id', 'value' => $this->id);
        }
        else if(isset($this->userid)){
            $search = array('col' => 'userid', 'value' => $this->userid);
        }
        else{
            $search = false;
        }
        if($search){
            $col = $search['col'];
            $stmt = $this->con->prepare("SELECT id, content, created, userid FROM $this->table WHERE $col = :val");
            $stmt->execute(array(
                ':val' => $search['value']
            ));
            $yadda = $stmt->fetchObject();
            $this->id = $yadda->id;
            $this->content = $yadda->content;
            $this->created = $yadda->created;
            $this->userid = $yadda->userid;
        }
    }

?>