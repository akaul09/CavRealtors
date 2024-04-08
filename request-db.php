<?php
function addProperty($housestyle,$price, $address, $brokername, $bathrooms, $bedrooms, $squarefeet, $state, $county, $status)
{
    global $db;
    $query = "INSERT INTO Property (name, price) VALUES (:housestyle,:price)";  
    $query2 = "INSERT INTO Location (Address, Locality, state) VALUES (:address,:county, :state)";  

    try { 
        // $statement = $db->query($query);   // compile & exe
  
        // prepared statement
        // pre-compile
        $statement = $db->prepare($query);
        $statement2 = $db->prepare($query2);
        // fill in the value
        $statement->bindValue(':housestyle', $housestyle);
        $statement->bindValue(':price', $price);
        $statement2->bindValue(':address',$address);
        $statement2->bindValue(':county',$county);
        $statement2->bindValue(':state',$state);
        // exe
        $statement->execute();
        $statement->closeCursor();
        $statement2->execute();
        $statement2->closeCursor();
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