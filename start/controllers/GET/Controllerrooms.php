<?php
include "C:/xampp/htdocs/chat_app/Back_end/start/models/Modelrooms.php";

    
    
       
       $id = $this->url[6];

       $filteredArray = [];
        
        $roomsarray = $rooms->selectAll("rooms");
// Loop through each user
foreach ($roomsarray as $room) {
    // Check if the user is not blocked
    $isBlocked = $rooms->selectWhere("*", "blockedfromroom", "userblockedid = $id AND roomid = {$room['id']}");
    
    // If not blocked, add the user to the filtered array
    if (empty($isBlocked)) {
        $filteredArray[] = $room;
    }
}
echo json_encode($filteredArray);

http_response_code(200);
       
       
        

    





?>