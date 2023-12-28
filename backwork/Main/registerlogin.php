<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


$uname = isset($_POST['uname']) ? $_POST['uname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';


                
				session_start();
				require("db/users.php");
				$objUser = new users;
				$objUser->setEmail($_POST['email']);
				$objUser->setName($_POST['uname']);
				$objUser->setLoginStatus(1);
			 	$objUser->setLastLogin(date('Y-m-d h:i:s'));
			 	$userData = $objUser->getUserByEmail();
			 	if(is_array($userData) && count($userData)>0) {
			 		$objUser->setId($userData['id']);
			 		if($objUser->updateLoginStatus()) {
                        
			 			$_SESSION['user'][$userData['id']] = $userData;
                         echo json_encode(['message' => $userData]);
			 			// header("location: chatroom.php");
			 		} else {
                        echo json_encode(['message' => 'FAILED LOGED']);
			 		}
			 	} else {
				 	if($objUser->save()) {
				 		$lastId = $objUser->dbConn->lastInsertId();
				 		$objUser->setId($lastId);
						$_SESSION['user'][$lastId] = [ 
							'id' => $objUser->getId(), 
							'name' => $objUser->getName(), 
							'email'=> $objUser->getEmail(), 
							'login_status'=>$objUser->getLoginStatus(), 
							'last_login'=> $objUser->getLastLogin() 
						];

                        echo json_encode(['message' => $_SESSION['user'][$lastId]]);
				 		// header("location: chatroom.php");
				 	} else {
                        echo json_encode(['message' => 'FAILLED LOGED']);
				 	}
				 }
			
		 ?>