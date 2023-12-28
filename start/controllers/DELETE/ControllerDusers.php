<?php
include "C:/xampp/htdocs/Survey-Corps_Blog/Back_end/start/models/ModelUsers.php";

if($_SERVER['REQUEST_METHOD'] === "DELETE"){
    if(empty($this->others)){
        http_response_code(301);
     echo json_encode(["message" => "nothing specifiyed"]);
    }else{
        echo $this->senderid; // hna ghanzid check dyal permision 
        $Users->delete("Utilisateurs","id_user = {$this->others[0]}");

    }
}else{
    echo "no perm";
}


?>