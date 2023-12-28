<?php
include "C:/xampp/htdocs/chat_app/Back_end/start/models/Modelusers.php";
if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if ($data !== null) {
       
        
        
        $usersArray = $users->selectWhere(
            "*", 
            "users", 
            "id IN (
                SELECT CASE
                    WHEN friend_id = {$data['id']} THEN user_id
                    WHEN user_id = {$data['id']} THEN friend_id
                END
                FROM friends 
                WHERE (friend_id = {$data['id']} OR user_id = {$data['id']}) 
                AND status = 'accepted'
            )"
        );
        
  
        

        $filteredArray = [];
        $id = $data["id"];
// Loop through each user
foreach ($usersArray as $user) {
    // Check if the user is not blocked
    $isBlocked = $users->selectWhere("*", "blocked", "user_id = $id AND blocked_user_id = {$user['id']}");
    
    // If not blocked, add the user to the filtered array
    if (empty($isBlocked)) {
        $filteredArray[] = $user;
    }
}
echo json_encode($filteredArray);
        http_response_code(200); 
    } else {
        
        echo "Failed to decode JSON data";
    }


}else{
    echo "no perm";
}


?>