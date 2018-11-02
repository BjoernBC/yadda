<?php 
require_once(rootPath . 'classes/models/model.php');
class ImgModel extends Model{
	private $con;
	private $id, $img, $imgtype, $alttext;

	public function __construct($table = "image") {
        parent::__construct();
        $this->con = $this->connect();
        $this->table = $table;
    }
	public function getId(){
    	return $this->id;
    }
    public function getImg(){
    	return $this->img;
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
    	$this->imgtype = $imgtype;
    }
    public function setAlt($alttext){
    	$this->alttext = $alttext;
    }

    public function create(){
    	$image = $_FILES['img']['tmp_name'];
    	$imgContent = addslashes(file_get_contents($image));

        $stmt = $this->con->prepare("INSERT INTO $this->table (file, mimetype, alttext) VALUES (:file, :mimetype, :alttext)");
        $stmt->execute(array(
            ':file' => $imgContent,
            ':mimetype' => $this->mimetype,
            ':alttext' => $this->alttext
        ));
    }
    public function update(){
    	$image = $_FILES['img']['tmp_name'];
    	$imgContent = addslashes(file_get_contents($image));

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
            $img = $stmt->fetchObject();
            $this->id = $img->id;
            $this->file = $img->content;
            $this->created = $img->created;
        }
    }
}
 ?>