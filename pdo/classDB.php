<?php

require_once "../includes/utils.php";

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

function insert($table,$user){
    try{
        $columns =implode(",", array_keys($user),);
        $placeholders = ":" . implode(", :", array_keys($user));
        $inst_query =  "INSERT INTO $table($columns) values ($placeholders) ";
        $stmt = $this->pdo->prepare($inst_query);
        foreach($user as $key => $value)
        {
        $stmt->bindValue(':'.$key,$value); 
        }
        $stmt-> execute();
        if($this->pdo->lastInsertId()){
            displaySuccess("Student inserted successfully {$this->pdo->lastInsertId()}");
        }
        return 0;}
        
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

    function selectRowData($table,$id){
        try{
       
            $query = "SELECT * FROM $table Where user_id=$id";
            $statement = $this->pdo->prepare($query);
            $res =$statement->execute();
            $result_set = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    
            return $result_set;
            
        }catch (PDOException $e){
                displayError($e->getMessage());
            }
        }


    function update($table,$id,$user) {
        # $user is array holds kry value pair name-> namevalue and sooo on
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
    

    function delete_data($table,$id){
        try{
            $delete_query = "delete from $table where user_id = :id";
            $stmt = $this->pdo->prepare($delete_query);
            $stmt->bindParam(':id', $id);
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