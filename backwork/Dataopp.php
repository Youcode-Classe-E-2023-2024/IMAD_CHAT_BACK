<?php

class DatabaseConnect
{
    private $pdo;

    public function __construct($dbname, $host, $username, $password)
    {
        $this->createDatabase($dbname, $host, $username, $password);
        $this->connect($dbname, $host, $username, $password);
    }

    private function createDatabase($dbname, $host, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
            
            // echo "Database created successfully!\n";
        } catch (PDOException $e) {
            echo "Error creating database: " . $e->getMessage() . "\n";
        }
    }

    private function connect($dbname, $host, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected to the database successfully!\n";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "\n";
        }
    }

    public function CreateTable($code)
    {
        try {
            $statement = $this->pdo->prepare($code);
            $statement->execute();
            // echo "Table created successfully!\n";
        } catch (Exception $e) {
            echo "Query execution failed: " . $e->getMessage() . "\n";
        }
    }

    public function selectAll($table) {
        $cond  = "";
        if($table === "Articles"){
            $cond = "WHERE deleted != 'yes'";
        }
        $pdo = $this->getPdo();
        $statement = $pdo->prepare("SELECT * FROM $table $cond");

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function selectWhere($VALUES = '*',$table, $where) {
        try {
            
        $pdo = $this->getPdo();
        $statement = $pdo->prepare("SELECT $VALUES FROM $table WHERE $where");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
       
        return $result;
        } catch (Exception $e) {
            echo "user not found". "\n";
        }
    }    

    public function Insert($table, $data)
{
    try {
        $pdo = $this->pdo;
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $statement = $pdo->prepare($query);

        foreach ($data as $key => &$value) {
            $statement->bindParam(":$key", $value);
        }
        unset($value); 

        $statement->execute();

        // Return the last inserted ID
        return $pdo->lastInsertId();
    } catch (Exception $e) {
        echo "Query execution failed: " . $e->getMessage() . "\n";
        return false; // You might want to handle this case based on your requirements
    }
}

    public function Update($table, $data,$condition)
{
    
    try {
        $pdo = $this->pdo;
        $comand = "";
        foreach ($data as $key => $value) {
            $comand .= "$key=:$key, ";
        }
        $comand = rtrim($comand, ', ');
        
        $query = "UPDATE $table SET $comand WHERE $condition";

        $statement = $pdo->prepare($query);

        foreach ($data as $key => $value) {
            $statement->bindParam(":$key", $data[$key]);
        }

        $statement->execute();
        $rowCount = $statement->rowCount();
        if ($rowCount > 0) {
            echo "Data updated successfully! Rows affected: $rowCount\n";
        } else {
            return "No rows updated";
        }
       
    } catch (Exception $e) {
        echo "Query execution failed: " . $e->getMessage() . "\n";
    }
}
public function Updatemder7a($id,$id2,$status)
{
    try {
        $pdo = $this->pdo;
       
        
      

        $query = "UPDATE friends
        SET status = '$status'
        WHERE user_id = $id AND friend_id = $id2;";

        $statement = $pdo->prepare($query);

        
        $statement->execute();
        $rowCount = $statement->rowCount();
        if ($rowCount > 0) {
            echo "Data updated successfully! Rows affected: $rowCount\n";
        } else {
            return "No rows updated";
        }
    } catch (Exception $e) {
        echo "Query execution failed: " . $e->getMessage() . "\n";
    }
}
public function delete($table, $where) {
    try {
    $pdo = $this->getPdo();
    $statement = $pdo->prepare("DELETE FROM $table WHERE $where");
    $statement->execute(); 
    $rowCount = $statement->rowCount();
        if ($rowCount > 0) {
            echo "Deleted successfully! Rows affected: $rowCount\n";
        } else {
            echo "No rows deleted. The specified condition might not match any existing rows.\n";
        }
    
    } catch (Exception $e) {
        echo "Query execution failed while delete: " . $e->getMessage() . "\n";
    }   
}  
    public function getPdo()
    {
        return $this->pdo;
    }
}



// $tableCreationCode = "CREATE TABLE IF NOT EXISTS table1 (
//     id INT PRIMARY KEY,
//     name VARCHAR(50),
//     age INT
// )";

// $conn->CreateTable($tableCreationCode);

// $conn = new DatabaseConnect('phpframe', 'localhost', 'root', '');
// $conn->delete("table1","id = 0");
// print_r($conn->selectWhere("table1","id = 0"));
// print_r($conn->selectAll("table1"));
// $conn->Insert("table1", ['name' => "ichrak", 'age' => '12']);
// $conn->Update("table1", ['name' => "ali", 'age' => '1'],"id = 0");
?>
