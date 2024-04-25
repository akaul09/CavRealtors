<?php
function addProperty($housestyle, $price)
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
   } catch (PDOException $e) {
      $e->getMessage();   // consider a generic message
      echo "$e";
   } catch (Exception $e) {
      $e->getMessage();   // consider a generic message
      echo "$e";
   }
}

function signup($fname, $lname, $username, $password) {
   global $db;
   $temp = password_hash($password, PASSWORD_DEFAULT);
   $db->beginTransaction();
   $defaultpermissiontype = 1;
   try {
      $queryUser = "INSERT INTO User (fname, lname, permissionType) VALUES (:fname, :lname, :permissionType)";
      $statementUser = $db->prepare($queryUser);
      $statementUser->bindValue(':fname', $fname);
      $statementUser->bindValue(':lname', $lname);
      $statementUser->bindValue(':permissionType', $defaultpermissiontype);
      $statementUser->execute();

      $userID = $db->lastInsertId();

      $queryNormalUser = "INSERT INTO NormalUser (userID, username, pword) VALUES (:userID, :username, :pword)";
      $statementNormalUser = $db->prepare($queryNormalUser);
      $statementNormalUser->bindValue(':userID', $userID);
      $statementNormalUser->bindValue(':username', $username);
      $statementNormalUser->bindValue(':pword', $temp);

      $statementNormalUser->execute();
      $db->commit();

      $statementUser->closeCursor();
      $statementNormalUser->closeCursor();
   } catch (PDOException $e) {
      $e->getMessage();   // consider a generic message
      echo "$e";
   } catch (Exception $e) {
      $e->getMessage();   // consider a generic message
      echo "$e";
   }
}
function getAllProperties() {
   global $db;
   $query = "select * from Property";
   $statement = $db->prepare($query);    // compile
   $statement->execute();
   $result = $statement->fetchAll();     // fetch()
   $statement->closeCursor();
   foreach($result as $key=>$property){
      $pid = $property["pid"];
      $featuresquery = "SELECT * FROM Features WHERE pid=:pid";
      $statement2= $db->prepare($featuresquery);
      $statement2->bindValue(':pid',$pid);
      $statement2->execute();
      $features = $statement2->fetchAll();
      $statement2->closeCursor();
      if (!empty($features)) {
         $result[$key]["bed"] = $features[0]["bed"];
         $result[$key]["bath"] = $features[0]["bath"];
         $result[$key]["sqft"] = $features[0]["sqft"];

      } else {
         $result[$key]["bed"] = "Bed info not found";
         $result[$key]["bath"] = "Bath info not found";
         $result[$key]["sqft"] = "Sqft info not found";
     }
   }
   return $result;
}

function getRequestById($id) {
   global $db;
   $query = "select * from requests where reqId=:reqId";
   $statement = $db->prepare($query);    // compile
   $statement->bindValue(':reqId', $id);
   $statement->execute();
   $result = $statement->fetch();
   $statement->closeCursor();

   return $result;
}
