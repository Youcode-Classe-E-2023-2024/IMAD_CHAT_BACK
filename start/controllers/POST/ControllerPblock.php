<?php
include "C:/xampp/htdocs/chat_app/Back_end/start/models/Modelusers.php";
if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if ($data !== null) {
       
        
        var_dump($data);
        if($data['blocker'] != $data['blocked']){
            $roomid =  $users->Insert("blocked", ["user_id" => $data["blocker"], "blocked_user_id" => $data["blocked"]]);
        }
        http_response_code(200); 
        

    } else {
        
        echo "Failed to decode JSON data";
    }


}else{
    echo "no perm";
}


?>