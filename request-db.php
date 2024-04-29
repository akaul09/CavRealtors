<?php


function addProperty($houseStyle, $price, $Address, $title, $bath, $bed, $sqft, $State, $Locality, $status) {
   global $db;
   $db->beginTransaction();

   try {
      $query = "CALL AddProperty(:housestyle, :price, :Address, :brokerName, :bath, :bed, :sqft, :State, :Locality, :status)";
      $statement = $db->prepare($query);

      // Bind parameters
      $statement->bindValue(':housestyle', $houseStyle);
      $statement->bindValue(':price', $price);
      $statement->bindValue(':Address', $Address);
      $statement->bindValue(':brokerName', $title);
      $statement->bindValue(':bath', $bath);
      $statement->bindValue(':bed', $bed);
      $statement->bindValue(':sqft', $sqft);
      $statement->bindValue(':State', $State);
      $statement->bindValue(':Locality', $Locality);
      $statement->bindValue(':status', $status);


      $statement->execute();
      $db->commit();  // Commit the transaction
      $statement->closeCursor();  // Close the cursor to free connection resources
   } catch (PDOException $e) {
      $db->rollBack(); // Roll back the transaction on error
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
      echo "<script>
      localStorage.setItem('username', '" . htmlspecialchars($username, ENT_QUOTES) . "');
      localStorage.setItem('type', 'Admin');
      window.location.href = 'profile.php';
    </script>";
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
      echo "<script>
      localStorage.setItem('username', '" . htmlspecialchars($username, ENT_QUOTES) . "');
      localStorage.setItem('type', 'Customer');
      window.location.href = 'profile.php';
    </script>";
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
            // Instead of setting session variables, we output JavaScript.
            echo "<script>
                    localStorage.setItem('username', '" . htmlspecialchars($username, ENT_QUOTES) . "');
                    localStorage.setItem('type', 'Admin');
                    window.location.href = 'profile.php';
                  </script>";
            exit();
         } else {
            header("Location: adminLogin.php?error=invalid_credentials");
            exit();
         }
      }
   }
}
function logout() {
   echo "<script>
   localstorage.clear();
 </script>";
   header("Location: index.php");
   exit();
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
            // Instead of setting session variables, we output JavaScript.
            echo "<script>
                    localStorage.setItem('username', '" . htmlspecialchars($username, ENT_QUOTES) . "');
                    localStorage.setItem('type', 'Customer');
                    window.location.href = 'profile.php';
                  </script>";
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

function getPropertyById($id) {
   global $db;
   $query = "SELECT * FROM Property where pid=:id";
   $statement = $db->prepare($query);    // compile
   $statement->bindValue(':id', $id);
   $statement->execute();
   $result = $statement->fetchAll();     // fetch()
   $statement->closeCursor();
   foreach ($result as $key => $property) {
      $pid = $property["pid"];
      $featuresquery = "SELECT * FROM Features WHERE pid=:pid";
      $statement2 = $db->prepare($featuresquery);
      $statement2->bindValue(':pid', $pid);
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
      $brokerquery = "SELECT * FROM Broker WHERE pid=:pid";
      $statement3 = $db->prepare($brokerquery);
      $statement3->bindValue(':pid', $pid);
      $statement3->execute();
      $broker = $statement3->fetchAll();
      $statement3->closeCursor();
      if (!empty($broker)) {
         $result[$key]["title"] = $broker[0]["title"];
      } else {
         if (!empty($broker)) {
            $result[$key]["title"] = "Broker info not found";
         }
      }
      $typequery = "SELECT * FROM Type WHERE pid=:pid";
      $statement4 = $db->prepare($typequery);
      $statement4->bindValue(':pid', $pid);
      $statement4->execute();
      $Type = $statement4->fetchAll();
      $statement4->closeCursor();
      if (!empty($Type)) {
         $result[$key]["status"] = $Type[0]["status"];
         $result[$key]["housestyle"] = $Type[0]["housestyle"];
      } else {
         if (!empty($Type)) {
            $result[$key]["status"] = "Status info not found";
            $result[$key]["housestyle"] = "Housestyle info not found";
         }
      }
      $locationquery = "SELECT * FROM Location WHERE pid=:pid";
      $statement5 = $db->prepare($locationquery);
      $statement5->bindValue(':pid', $pid);
      $statement5->execute();
      $location = $statement5->fetchAll();
      $statement5->closeCursor();
      if (!empty($location)) {
         $result[$key]["locality"] = $location[0]["Locality"];
         $result[$key]["state"] = $location[0]["State"];
      } else {
         if (!empty($location)) {
            $result[$key]["locality"] = "Locality info not found";
            $result[$key]["state"] = "State info not found";
         }
      }
   }
   return $result;
}

function deletePropertyById($id) {
   global $db;
   $db->beginTransaction();  // Start the transaction

   try {
      $query = "CALL DeleteProperty(:input_pid)";
      $statement = $db->prepare($query);

      $statement->bindValue(':input_pid', intval($id));
      $statement->execute();
      $db->commit();
      $statement->closeCursor();
      header("Location: viewProperty.php");
      exit();
   } catch (PDOException $e) {
      $db->rollBack(); // Roll back the transaction on error
      echo "PDOException: " . $e->getMessage();
   } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
   }
}
function temp($p, $n) {
   echo $p;
   echo $n;
}
function UpdatePropertyById($pid, $houseStyle, $status, $title, $bath, $bed, $sqft, $Address, $Locality, $State, $price) {
   global $db;
   $db->beginTransaction();
   try {
      $query = "CALL UpdateProcedure(:input_pid,:newHouseStyle, :newStatus, :newBrokerName, :newBathrooms, :newBedrooms, :newSQFT, :newAddress, :newLocality, :newState, :newPrice)";
      $statement = $db->prepare($query);

      $statement->bindValue(':input_pid', $pid);
      $statement->bindValue(':newHouseStyle', $houseStyle);
      $statement->bindValue(':newStatus', $status);
      $statement->bindValue(':newBrokerName', $title);
      $statement->bindValue(':newBathrooms', $bath);
      $statement->bindValue(':newBedrooms', $bed);
      $statement->bindValue(':newSQFT', $sqft);
      $statement->bindValue(':newAddress', $Address);
      $statement->bindValue(':newLocality', $Locality);
      $statement->bindValue(':newState', $State);
      $statement->bindValue(':newPrice', $price);


      $statement->execute();
      // echo $price;
      $db->commit(); 
      $statement->closeCursor();
      header("Location: viewProperty.php");
   } catch (PDOException $e) {
      $db->rollBack();
      echo "PDOException: " . $e->getMessage();
   } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
   }
}
function exportJson() {
   global $db;
   $query = "SELECT * FROM Property";
   $statement = $db->prepare($query);    // compile
   $statement->execute();
   $result = $statement->fetchAll();     // fetch()
   $statement->closeCursor();
   foreach ($result as $key => $property) {
      $pid = $property["pid"];
      $featuresquery = "SELECT * FROM Features WHERE pid=:pid";
      $statement2 = $db->prepare($featuresquery);
      $statement2->bindValue(':pid', $pid);
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
      $brokerquery = "SELECT * FROM Broker WHERE pid=:pid";
      $statement3 = $db->prepare($brokerquery);
      $statement3->bindValue(':pid', $pid);
      $statement3->execute();
      $broker = $statement3->fetchAll();
      $statement3->closeCursor();
      if (!empty($broker)) {
         $result[$key]["title"] = $broker[0]["title"];
      } else {
         if (!empty($broker)) {
            $result[$key]["title"] = "Broker info not found";
         }
      }
      $typequery = "SELECT * FROM Type WHERE pid=:pid";
      $statement4 = $db->prepare($typequery);
      $statement4->bindValue(':pid', $pid);
      $statement4->execute();
      $Type = $statement4->fetchAll();
      $statement4->closeCursor();
      if (!empty($Type)) {
         $result[$key]["status"] = $Type[0]["status"];
         $result[$key]["housestyle"] = $Type[0]["housestyle"];
      } else {
         if (!empty($Type)) {
            $result[$key]["status"] = "Status info not found";
            $result[$key]["housestyle"] = "Housestyle info not found";
         }
      }
      $locationquery = "SELECT * FROM Location WHERE pid=:pid";
      $statement5 = $db->prepare($locationquery);
      $statement5->bindValue(':pid', $pid);
      $statement5->execute();
      $location = $statement5->fetchAll();
      $statement5->closeCursor();
      if (!empty($location)) {
         $result[$key]["locality"] = $location[0]["Locality"];
         $result[$key]["state"] = $location[0]["State"];
      } else {
         if (!empty($location)) {
            $result[$key]["locality"] = "Locality info not found";
            $result[$key]["state"] = "State info not found";
         }
      }
   }
   $json = json_encode($result);
    if ($json === false) {
        echo "JSON encode error: " . json_last_error_msg();
        return;
    }

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="export.json"');
    echo $json;
    exit();
}

function sortPrices(){
   global $db;
   $query = "SELECT * FROM Property ORDER BY price ASC";
   $statement = $db->prepare($query);    
   $statement->execute();
   $result = $statement->fetchAll();     
   $statement->closeCursor();
   return $result;
}

function sortPricesDesc(){
   global $db;
   $query = "SELECT * FROM Property ORDER BY price DESC";
   $statement = $db->prepare($query);    
   $statement->execute();
   $result = $statement->fetchAll();     
   $statement->closeCursor();
   return $result;
}