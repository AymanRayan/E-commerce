<?php  

session_start();

// class Db{
//    var $server;
//    var $dbName;
//    var $dbUser;
//    var $dbPassword;
//    var $con;
//    function Db ($a,$b,$c,$d = ""){
//        $this->server = $a;
//        $this->dbName = $b;
//        $this->dbUser = $c;
//        $this->dbPassword = $d;
//        $this->con =mysqli_connect($this->server,$this->dbUser,$this->dbPassword,$this->dbName);
//    }

//    function doQuery($sql)
//    {
//        $result = mysqli_query($this->con, $sql);
//        return $result;
//    }
   
// }
// $x= new Db("localhost","ecommercepro","root");
// $name ="ayman";
// $sql = "insert into users (name) values ('$name')";
// echo '$x->doQuery($sql)';


$server = "localhost";
$dbName = "project";
$dbUser = "root";
$dbPassword= "";

 $con =   mysqli_connect($server,$dbUser,$dbPassword,$dbName);
 
 if(!$con){
     die('Error '.mysqli_connect_error() );
 }
   

?>