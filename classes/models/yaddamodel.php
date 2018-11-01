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
        $stmt = $this->con->prepare("INSERT INTO $this->table (content, created, edited, userid) VALUES (:content, :created, :userid)");
        $stmt->execute(array(
            ':content' => $this->content,
            ':created' => $this->created,
            ':edited' => $this->edited,
            ':userid' => $this->userid
        ));
    }
    public function update(){
        $stmt = $this->con->prepare("UPDATE $this->table SET content = :content, edited = :edited, userid = :userid WHERE id = :id");
        $stmt->execute(array(
            ':id' => $this->id,
            ':content' => $this->content,
            ':edited' => $this->edited,
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
        else{
            $search = false;
        }
        if($search){
            $col = $search['col'];
            $stmt = $this->con->prepare("SELECT id, content, created, edited, userid FROM $this->table WHERE $col = :val");
            $stmt->execute(array(
                ':val' => $search['value']
            ));
            $yadda = $stmt->fetchObject();
            $this->id = $yadda->id;
            $this->content = $yadda->content;
            $this->created = $yadda->created;
            $this->edited = $yadda->edited;
            $this->userid = $yadda->userid;
        }
    }
}
?>