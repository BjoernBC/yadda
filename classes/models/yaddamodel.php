<?php 
require_once(rootPath . 'classes/models/model.php');
require_once(rootPath . 'classes/models/usermodel.php');
require_once(rootPath . 'classes/models/imgmodel.php');
class YaddaModel extends Model {
    private $con;
    private $id, $content, $created, $edited, $userid, $user, $children;
    public function __construct($table = "yadda") {
        parent::__construct();
        $this->con = $this->connect();
        $this->table = $table;
    }

    public function getId(){
    	return $this->id;
    }
    public function getContent(){
        return $this->content;
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
    public function getUser(){
        return $this->user;
    }

    public function setId($id){
    	$this->id = $id;
    }
    public function setContent($content){
        $this->content = $content;
    }
    public function setEdited($edited){
    	$this->edited = $edited;
    }
    public function setUserid($userid){
    	$this->userid = $userid;
    }
    public function setChildren($children){
        $this->children = $children;
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
            echo $col;
            if (strlen($col) > 1) {
                echo 'asdf';
            }
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
            $user = new UserModel();
            $user->setId($this->userid);
            $user->retrieve();
            $this->user = $user;
            /*$img = new ImgModel();
            $img->setId($this->id);
            $img->retrieve();
            $this->img = $img;*/
            // $this->alttext = $alttext;
        }
    }
    public function retrieveAll(){
        $yaddas = array();
        $relations = array();
        $sql = "SELECT id, content FROM $this->table ORDER BY id DESC";
        foreach($this->con->query($sql) as $row){
            $yaddas[$row['id']] = $row;
        }
        $sql = "SELECT parent, child FROM yadda_rel";
        foreach($this->con->query($sql) as $row){
            $relations[$row['parent']][] = $row['child'];
            $children[] = $row['child'];
        }
        $yaddaSorted = array();
        foreach($yaddas as $key => $yadda){
            if(!in_array($key, $children)){
                    $yaddaM = new YaddaModel();
                    $yaddaM->setId($key);
                    $yaddaM->retrieve();
                    $temp = $this->recurs($relations[$key], $yaddas, $relations);
                    if(is_array($temp)){
                        $yaddaM->setChildren($temp);
                    }
                $yaddaSorted[] = $yaddaM;
            }
        }
        return $yaddaSorted;
    }
    private function recurs($arr, $yaddas, $relations){
        if(is_array($arr)){
            foreach($arr as $child){
                $yaddaM = new YaddaModel();
                $yaddaM->setId($child);
                $yaddaM->retrieve();
                $yad = $yaddas[$child];
                    $temp = $this->recurs($relations[$child], $yaddas, $relations);
                if(is_array($temp)){
                    $yaddaM->setChildren($temp);
                }
                $newArr[] = $yaddaM;
            }
            if(is_array($newArr)){
                return $newArr;
            }
        }
    }
}
?>