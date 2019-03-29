<?php


class Size extends DataBase implements Action {
    
    private $id;
    private $size;
    private $price;
    
    public function __construct($size = null, $price = -1) {
        $this->id = -1;
        $this->size = $size;
        $this->price = $price;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getSize(){
        return $this->size;
    }
    
    public function setSize($size){
        $this->size = $size;
        
        return $this;
    }
    
    public function setPrice($price){
        $this->price = $price;
        return $this;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    
    public function loadFromDB($id)
    {
        
        $sql = "SELECT * FROM size WHERE id = $id";
        if ($result = self::$conn->query($sql)) {
            $row = $result->fetch_assoc();
            
            $this->id = $row['id'];
            
            return $row;
            
        } return false;
    }
    
    public function saveToDB()
    {
        $size = self::$conn->real_escape_string($this->size);
        $price = self::$conn->real_escape_string($this->price);

        $sql = "INSERT INTO size(size, price) VALUES ('$size', '$price')";
        
        
        if ($result = self::$conn->query($sql)) {
            $this->id = self::$conn->insert_id;
            $this->size = $size;
            $this->price = $price;

            return $this;
            
        } else return false;
    }

    public function update()
    {
        $size = self::$conn->real_escape_string($this->size);
        $price = self::$conn->real_escape_string($this->price);
        
        $sql = "UPDATE size SET size='$size', price='$price' "
            . "WHERE id=$this->id";
        
        $result = self::$conn->query($sql);

        if ($result = self::$conn->query($sql)) {

            return $this;
        } return false;
    }

    public function deleteFromDB()
    {
        
        $sql = "DELETE FROM size WHERE id=$this->id";

        if ($result = self::$conn->query($sql)) {
            $this->id = -1;
            
            return true;
            
        } return false;
        
    }

    public static function loadAllFromDB() {
        $sql = "SELECT * FROM size";

         if ($result = self::$conn->query($sql)) {
            foreach ($result as $key => $value) {
                $row[$key] = $value;
            }
            return $row;
        } return false;
    }
}