<?php
include "C:/xampp/htdocs/Survey-Corps_Blog/Back_end/start/models/ModelAnonce.php";
if($_SERVER['REQUEST_METHOD'] === "DELETE"){
    if(empty($this->others)){
        http_response_code(301);
     echo json_encode(["message" => "nothing specifiyed"]);
    }else{
        echo $this->senderid; // hna ghanzid check dyal permision 
        $permissions =  $Anonce->selectWhere('id_Permission ',"affecter_user_permissions","id_user = {$this->senderid} AND id_Permission = 2");
        
        if($permissions){
            // $Anonce->delete("Articles","ArticleID = {$this->others[0]}");
            $Anonce->Update("Articles",["deleted"=>"yes"],"ArticleID = {$this->others[0]}");
        }else{
            echo "no permission for the delete";
        }
        

    }
}else{
    echo "no perm";
}


?>