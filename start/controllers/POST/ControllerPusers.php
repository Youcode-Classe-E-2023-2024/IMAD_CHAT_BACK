<?php
include "C:/xampp/htdocs/chat_app/Back_end/start/models/Modelusers.php";
if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if ($data !== null) {
       
        $searchValue = $data['searchval'];
$id = $data['id'];

// Fetch all users whose names match the search value
$usersArray = $users->selectWhere("*", "users", "name LIKE '%{$searchValue}%'");

// Create an array to store the filtered users
$filteredArray = [];

// Loop through each user
foreach ($usersArray as $user) {
    // Check if the user is not blocked
    $isBlocked = $users->selectWhere("*", "blocked", "user_id = $id AND blocked_user_id = {$user['id']}");
    
    // If not blocked, add the user to the filtered array
    if (empty($isBlocked)) {
        $filteredArray[] = $user;
    }
}

// Encode and echo the filtered array
echo json_encode($filteredArray);
http_response_code(200);




    } else {
        
        echo "Failed to decode JSON data";
    }


}else{
    echo "no perm";
}


?>