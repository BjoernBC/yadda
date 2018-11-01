<?php 
require_once('classes/models/model.php');
class ImgModel extends Model{
	private $con;
	private $id, $img, $imgtype, $alttext;

	public function __construct($table = "img") {
        parent::__construct();
        $this->con = $this->connect();
        $this->table = $table;
    }
	public function getId(){
    	return $this->id;
    }
    public function getImg(){

    	return $this->imgContent;
    }
    public function getMime(){
    	return $this->imgtype;
    }
    public function getAlt(){
    	return $this->alttext;
    }

	public function setId($id){
    	$this->id = $id;
    }
    public function setImg($img){
    	$this->img = $img;
    }
	public function setMime($img){
    	$this->imgtype = $img;
    }
    public function setAlt($alttext){
    	$this->alttext = $alttext;
    }

    public function create(){
    	$img = $_FILES['img']['tmp_name'];
    	$imgContent = addslashes(file_get_contents($img));

        $stmt = $this->con->prepare("INSERT INTO $this->table (file, mimetype, alttext) VALUES (:file, :mimetype, :alttext)");
        $stmt->execute(array(
            ':file' => $imgContent,
            ':mimetype' => $this->mimetype,
            ':alttext' => $this->alttext
        ));
    }
    public function update(){
    	$img = $_FILES['img']['tmp_name'];
    	$imgContent = addslashes(file_get_contents($img));

        $stmt = $this->con->prepare("UPDATE $this->table SET file = :file, mimetype = :mimetype, alttext = :alttext WHERE id = :id");
        $stmt->execute(array(
            ':id' => $this->id,
            ':file' => $imgContent,
            ':mimetype' => $this->mimetype,
            ':alttext' => $this->alttext
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
            $stmt = $this->con->prepare("SELECT id, file, mimetype, alttext FROM $this->table WHERE $col = :val");
            $stmt->execute(array(
                ':val' => $search['value']
            ));
            $image = $stmt->fetchObject();
            $this->id = $image->id;
            $this->file = $image->content;
            $this->created = $image->created;
            $this->userid = $image->userid;
        }
    }

}
 ?>