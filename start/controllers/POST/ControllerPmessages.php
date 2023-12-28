<?php
include "C:/xampp/htdocs/chat_app/Back_end/start/models/Modelmessages.php";
if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if ($data !== null) {
       
        
        
        echo json_encode($messages->selectWhere("*","chatrooms","roomid = {$data["roomid"]}"));
        

    } else {
        
        echo "Failed to decode JSON data";
    }


}else{
    echo "no perm";
}


?>