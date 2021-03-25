<?php
class Database
{
public $dbConn = Null;
    public function connect()
    {
    define("hostname","localhost");
    define("user","SaKuRaSou");
    define("password", "XDdBjqoDos5609zt");
    define("dbname","bookstore");
    $this->dbConn = new mysqli(hostname, user, password, dbname);
    $this->dbConn->query("SET NAMES UTF8");
    // Check connection
    if ($this->dbConn -> connect_errno) {
        die("Database Connection Error, Error No.: " .
                $this->dbConn->connect_errno . " | " .
                $this->dbConn->connect->connect_error);
               
    }else{
        echo "Connect success....";
    }
}
public function Show_Book(){
        $SQL_Query = "SELECT `BookID`, `BookName`, `TypeID`, `StatusID`, `Publish`, `UnitPrice`, `UnitRent`, `DayAmount`, `BookDate` FROM `book` WHERE 1";
        $result=$this->dbConn->query($SQL_Query);
            echo "<table border='1'>";
            $counter=0;
            while ($row=$result->fetch_assoc()){
                if($counter==0){
                    echo "<tr><th colspan='10'><h1>Book Store</h1></th></tr>";
                    echo "<tr><th colspan='10' align='left'><a href='insertBook.php'>+Book</a></th></tr>";
                    echo "<tr>";
                    foreach($row as $key=>$value){
                        echo "<th>{$key}</th>";
                        
                    }
                    echo "<th>OPERATION</th>";
                    echo "</tr>";
                    $counter++;
                }
                echo "</tr>";
                foreach($row as $key=>$value){
                    echo "<th>{$value}</th>"; 
                    
                }
                echo "<td><a href=''>Delete</a></td>";
                echo "</tr>";
                
            }
            
            echo "</table>";
    }
    public function disconnect(){
        $this->dbConn->close();
    }
}
?>