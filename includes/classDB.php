<?php

require_once "../../includes/utils.php";

class dataBase{
private $pdo;
function connectToDB($db_host,$db_name,$db_user,$db_password) {
    try{
        $this->pdo = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
        return $this->pdo;
    }
    catch(PDOException $e){
        displayError($e->getMessage());
    }
}

function insert($table,$data){
    // data is associateve  array  key => value , 
    try{
        $columns =implode(",", array_keys($data),);
        $placeholders = ":" . implode(", :", array_keys($data));
        $inst_query =  "INSERT INTO $table($columns) values ($placeholders) ";
        $stmt = $this->pdo->prepare($inst_query);
        foreach($data as $key => $value)
        {
        $stmt->bindValue(':'.$key,$value); 
        }
        $stmt-> execute();
        if($this->pdo->lastInsertId()){
            displaySuccess("Student inserted successfully {$this->pdo->lastInsertId()}");
        }
        return $this->pdo->lastInsertId();}
        
        catch(PDOException $e){
        displayError($e->getMessage());
        return 1 ;
        }
}





function select_data($table){
    try{
        $query = "SELECT * FROM $table";
        $statement = $this->pdo->prepare($query);
        $res =$statement->execute();
        
        $result_set = $statement->fetchAll(PDO::FETCH_ASSOC);


        return $result_set;
        
    }catch (PDOException $e){
            displayError($e->getMessage());
        }
    }



    function selectRowData($table, $column, $value) {
        try{
       
            $query = "SELECT * FROM $table Where $column=$value";
            $statement = $this->pdo->prepare($query);
            $res =$statement->execute();
            $result_set = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    
            return $result_set;
            
        }catch (PDOException $e){
                displayError($e->getMessage());
            }
        }


    function update($table,$id,$user) {
        # $user is array holds key value pair name-> namevalue and sooo on
        try {
            $inst_query = "UPDATE $table 
                           SET name = :name, 
                               email = :email, 
                               room_no = :room, 
                               ext = :ext, 
                               image = :image 
                           WHERE user_id = :id";
    
            $stmt = $this->pdo->prepare($inst_query);
    
            $stmt->bindValue(":name", $user['name']);
            $stmt->bindValue(":email", $user['email']);
            $stmt->bindValue(":image", $user['image']);
            $stmt->bindValue(":ext", $user['ext']);
            $stmt->bindValue(":room", $user['room_no']);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                displaySuccess("Student updated successfully");
            } else {
                displayError("No changes made or user not found.");
            }
    
            return 0;
        } catch (PDOException $e) {
            displayError($e->getMessage());
            return 1;
        }
    }
    

    function delete_data($table,$colCond,$colVal){
        try{
            $delete_query = "delete from $table where $colCond = :colVal";
            $stmt = $this->pdo->prepare($delete_query);
            $stmt->bindParam(':colVal', $colVal);
            $stmt->execute();
            if($stmt->rowCount()){
                displaySuccess("Delete Successful");
            }else{
                displayError("Delete Failed");
            }
        }catch (PDOException $e){
            displayError($e->getMessage());
        }
    
    }

    function getPendingOrderIds() {
        try {
            $query = "SELECT order_id FROM orders WHERE status = 'pending'";
            $statement = $this->pdo->query($query);
            return $statement->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            displayError($e->getMessage());
        }
    }


    function selectCell($table, $column, $condCol, $condVal) {
        try {
            $query = "SELECT $column FROM $table WHERE $condCol = :condVal LIMIT 1";
            $stmt = $this->pdo->prepare($query);
    
            $stmt->bindValue(":condVal", $condVal);
            $stmt->execute();
    
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                return $result[$column];  // Return the value of the selected column
            } else {
                return null;  // Return null if no result found
            }
        } catch (PDOException $e) {
            displayError($e->getMessage());
            return false;
        }
    }
    
    

    function updateCell($table, $column, $value, $condCol, $condVal) {
        try {
            $query = "UPDATE $table SET $column = :value WHERE $condCol = :condVal";
            $stmt = $this->pdo->prepare($query);
    
            $stmt->bindValue(":value", $value);
            $stmt->bindValue(":condVal", $condVal);
        $stmt->execute();
            return true;
        } catch (PDOException $e) {
            displayError($e->getMessage());
            return false;
        }
    }
    

    

    function descTable($table){
        try{
            $query = "desc $table";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result_set;
        }catch (PDOException $e){
            displayError($e->getMessage());
        }
    
    }

    



    function closeConnection(){
        try{
            if (!$this->pdo){
                // displayError("Connection isn't opened to close it :D :D ");

            }
            else{

                $this->pdo=null;

                // displaySuccess("Connection Closed Successful");

            }
        }
        catch(PDOException $e)
        {
            displayError($e->getMessage());

        }

    }



}