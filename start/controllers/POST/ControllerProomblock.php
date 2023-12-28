<?php
include "C:/xampp/htdocs/chat_app/Back_end/start/models/Modelusers.php";
if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if ($data !== null) {
       
        
        var_dump($data);
        
            $roomid =  $users->Insert("blockedfromroom", ["roomid" => $data["roomid"], "userblockedid" => $data["userblocked"]]);
        
        http_response_code(200); 
        

    } else {
        
        echo "Failed to decode JSON data";
    }


}else{
    echo "no perm";
}


?>