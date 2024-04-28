<?php


function addProperty($houseStyle, $price, $name, $Address, $title, $bath, $bed, $sqft, $State, $Locality, $status) {
   global $db;
   $db->beginTransaction();  

   try {
       echo "Preparing to execute stored procedure...";
       $query = "CALL AddProperty(:housestyle, :price, :name, :Address, :title, :bath, :bed, :sqft, :State, :Locality, :status)";
       $statement = $db->prepare($query);

       $statement->bindValue(':housestyle', $houseStyle);
       $statement->bindValue(':price', $price);
       $statement->bindValue(':name', $name);
       $statement->bindValue(':Address', $Address);
       $statement->bindValue(':title', $title);
       $statement->bindValue(':bath', $bath);
       $statement->bindValue(':bed', $bed);
       $statement->bindValue(':sqft', $sqft);
       $statement->bindValue(':State', $State);
       $statement->bindValue(':Locality', $Locality);
       $statement->bindValue(':status', $status);

      
       $statement->execute();
       echo "Stored procedure executed.";
       $db->commit();  
       $statement->closeCursor(); 
   } catch (PDOException $e) {
       $db->rollBack(); 
       echo "PDOException: " . $e->getMessage();
   } catch (Exception $e) {
       echo "Exception: " . $e->getMessage();
   }
}

function signupAdmin($fname, $lname, $username, $password) {
   global $db;
   $temp = password_hash($password, PASSWORD_DEFAULT);
   $db->beginTransaction();
   $adminpermissiontype = 0;
   try {
      $queryUser = "INSERT INTO User (fname, lname, permissionType) VALUES (:fname, :lname, :permissionType)";
      $statementUser = $db->prepare($queryUser);
      $statementUser->bindValue(':fname', $fname);
      $statementUser->bindValue(':lname', $lname);
      $statementUser->bindValue(':permissionType', $adminpermissiontype);
      $statementUser->execute();

      $userID = $db->lastInsertId();

      $queryAdminUser = "INSERT INTO Admin (userID, username, pword) VALUES (:userID, :username, :pword)";
      $statementNormalUser = $db->prepare($queryAdminUser);
      $statementNormalUser->bindValue(':userID', $userID);
      $statementNormalUser->bindValue(':username', $username);
      $statementNormalUser->bindValue(':pword', $temp);

      $statementNormalUser->execute();
      $db->commit();

      $statementUser->closeCursor();
      $statementNormalUser->closeCursor();
      $_SESSION["username"] = $username;
      $_SESSION["type"] = 1;
      header("Location: viewProperty.php");
   } catch (PDOException $e) {
      $e->getMessage();   // consider a generic message
      echo "$e";
      header("Location: signup.php?error=invalid");
      exit();
   } catch (Exception $e) {
      $e->getMessage();   // consider a generic message
      echo "$e";
      header("Location: signup.php?error=invalid");
      exit();
   }
}
function signupNormal($fname, $lname, $username, $password) {
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
      $_SESSION["username"] = $username;
      $_SESSION["type"] = 1;
      header("Location: viewProperty.php");
      exit();
   } catch (PDOException $e) {
      $e->getMessage();   // consider a generic message
      echo "$e";
      header("Location: signup.php?error=invalid");
      exit();
   } catch (Exception $e) {
      $e->getMessage();   // consider a generic message
      echo "$e";
      header("Location: signup.php?error=invalid");
      exit();
   }
}
function Adminlogin($username, $password) {
   global $db;
   if (
      !empty($username) && !empty($password)
   ) {
      $query = "select * from Admin where username = :username;";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->execute();
      $res = $statement->fetchAll();
      $statement->closeCursor();
      if (!empty($res)) {
         if (password_verify($password, $res[0]["pword"])) {
            // Password was correct, save their information to the
            // session and send them to the question page
            $_SESSION["username"] = $res[0]["username"];
            $_SESSION["type"] = 1;
            header("Location: viewProperty.php");
            exit();
         } else {
            header("Location: adminLogin.php?error=invalid_credentials");
            exit();
         }
      }
   }
}
function custLogin($username, $password) {
   global $db;
   if (
      !empty($username) && !empty($password)
   ) {
      $query = "select * from NormalUser where username = :username;";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->execute();
      $res = $statement->fetchAll();
      $statement->closeCursor();
      if (!empty($res)) {
         if (password_verify($password, $res[0]["pword"])) {
            // Password was correct, save their information to the
            // session and send them to the question page
            $_SESSION["username"] = $res[0]["username"];
            $_SESSION["type"] = 1;
            header("Location: viewProperty.php");
            exit();
         } else {
            header("Location: custLogin.php?error=invalid_credentials");
            exit();
         }
      }
   }
}
function getAllProperties($page = 1, $propertiesPerPage = 10) {
   global $db;
   $startFrom = ($page - 1) * $propertiesPerPage;
   
   $query = "SELECT * FROM Property LIMIT :startFrom, :propertiesPerPage";
   $statement = $db->prepare($query);
   $statement->bindValue(':startFrom', $startFrom, PDO::PARAM_INT);
   $statement->bindValue(':propertiesPerPage', $propertiesPerPage, PDO::PARAM_INT);
   $statement->execute();
   $properties = $statement->fetchAll();
   $statement->closeCursor();

   foreach ($properties as $key => $property) {
       $pid = $property["pid"];
       $featuresQuery = "SELECT * FROM Features WHERE pid=:pid";
       $featuresStmt = $db->prepare($featuresQuery);
       $featuresStmt->bindValue(':pid', $pid);
       $featuresStmt->execute();
       $features = $featuresStmt->fetchAll();
       $featuresStmt->closeCursor();
       if (!empty($features)) {
           $properties[$key]["bed"] = $features[0]["bed"];
           $properties[$key]["bath"] = $features[0]["bath"];
           $properties[$key]["sqft"] = $features[0]["sqft"];
       } else {
           $properties[$key]["bed"] = "Bed info not found";
           $properties[$key]["bath"] = "Bath info not found";
           $properties[$key]["sqft"] = "Sqft info not found";
       }
   }
   return $properties;
}
function getRequestById($id) {
   global $db;
   $query = "select * from requests where reqId=:reqId";
   $statement = $db->prepare($query);    
   $statement->bindValue(':reqId', $id);
   $statement->execute();
   $result = $statement->fetch();
   $statement->closeCursor();

   return $result;
}

