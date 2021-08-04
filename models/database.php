<?php

class database {
    
    private $hostname = hostname;
    private $username = username;
    private $password = password;
    private $db_name = db_name;
    public $connection_link;

    function __construct() {
        $this->connection_link = $this->db_connection($this->hostname, $this->username, $this->password, $this->db_name);  
    }
    
    private function db_connection($hostname, $username, $password,$db_name) 
    {
        $conn = new mysqli($hostname, $username, $password,$db_name);
        return ($conn) ?  $conn : die("$conn->connect_error") ;   
    }
    
    public function close_db()
    {
        $this->connection_link->close(); 
    }
    
    public function clean_query($string)
    {
        return htmlentities($this->connection_link->real_escape_string(stripslashes($string)));
    }
    
    public function make_query($query)
    {
        $result = $this->connection_link->query($query);
        return ($result) ? $result : false;
    }
    
    public function update_data($tabel,$data,$key,$id)
    {
        $query = "UPDATE " . $tabel . " SET  ".$data . " WHERE  ".$key."=".$id;
        $result = $this->make_query($query);
        return ($result) ? $result : die($this->connection_link->error);
    }
   
    public function insert_data($tabel,$coulmns,$data)
    {
        $query = "INSERT INTO $tabel ($coulmns) VALUES ($data);";
        return $this->make_query($query);
    }
    
    
    public function delete_data($tabel,$key,$id){
        $query = "DELETE FROM " . $tabel. " WHERE  ".$key."=" . $id;
        $result = $this->make_query($query);
        return ($result) ? $result : die($this->connection_link->error);
    }


}
