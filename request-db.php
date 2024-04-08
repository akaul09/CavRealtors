<?php
function addProperty($housestyle,$price)
// $Address, $title, $bath, $bed, $sqft, $State, $Locality, $status)
{
    global $db;
    $query = "INSERT INTO Property (name, price) VALUES (:housestyle,:price)";  

    try { 
        // $statement = $db->query($query);   // compile & exe
  
        // prepared statement
        // pre-compile
        $statement = $db->prepare($query);
        // fill in the value
        $statement->bindValue(':housestyle', $housestyle);
        $statement->bindValue(':price', $price);
        
        // $statement->bindValue(':status', $status);
        // $statement->bindValue(':title', $title);
        // $statement->bindValue(':Address', $Address);
        // $statement->bindValue(':title', $title);
        // $statement->bindValue(':bath', $bath);
        // $statement->bindValue(':bed', $bed);
        // $statement->bindValue(':sqft', $sqft);
        // $statement->bindValue(':State', $State);
        // $statement->bindValue(':Locality', $Locality);

        // exe
        $statement->execute();
        $statement->closeCursor();
       
     } catch (PDOException $e)
     {
        $e->getMessage();   // consider a generic message
        echo "$e";
     } catch (Exception $e) 
     {
        $e->getMessage();   // consider a generic message
        echo "$e";
     }
}

function signup($username,$password){
   global $db;
   $temp = password_hash($password, PASSWORD_DEFAULT);
   $query = "INSERT INTO NormalUser (username, pword) VALUES (:username, :pword)";
   try { 
   $statement = $db->prepare($query);
        // fill in the value
        $statement->bindValue(':username', $username);
        $statement->bindValue(':pword', $temp);
        $statement->execute();
        $statement->closeCursor();
       
     } catch (PDOException $e)
     {
        $e->getMessage();   // consider a generic message
        echo "$e";
     } catch (Exception $e) 
     {
        $e->getMessage();   // consider a generic message
        echo "$e";
     }
        
}
function getAllProperties()
{
   global $db;
   $query = "select * from Property";    
   $statement = $db->prepare($query);    // compile
   $statement->execute();
   $result = $statement->fetchAll();     // fetch()
   $statement->closeCursor();

   return $result;
}

function getRequestById($id)  
{
   global $db;
   $query = "select * from requests where reqId=:reqId"; 
   $statement = $db->prepare($query);    // compile
   $statement->bindValue(':reqId', $id);
   $statement->execute();
   $result = $statement->fetch();
   $statement->closeCursor();

   return $result;
}


?>