<?php
include "C:/xampp/htdocs/chat_app/Back_end/start/models/Modelrooms.php";
if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if ($data !== null) {
       
        
        
       $roomid =  $rooms->Insert("rooms", ["name" => $data["name"], "owner" => $data["owner"]]);
       echo $roomid;
       http_response_code(200); 

    } else {
        
        echo "Failed to decode JSON data";
    }


}else{
    echo "no perm";
}


?>