<?php
include "C:/xampp/htdocs/chat_app/Back_end/start/models/Modelusers.php";
if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if ($data !== null) {
       
        
        
        echo json_encode($users->selectWhere("*", "users", "id IN (SELECT user_id FROM friends WHERE friend_id = {$data['id']} AND status = 'pending')"));

        
        http_response_code(200); 
    } else {
        
        echo "Failed to decode JSON data";
    }


}else{
    echo "no perm";
}


?>