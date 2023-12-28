<?php
include "C:/xampp/htdocs/Survey-Corps_Blog/Back_end/start/models/ModelUsers.php";
if($_SERVER['REQUEST_METHOD'] === "PUT"){
    if(empty($this->others)){
        http_response_code(301);
     echo json_encode(["message" => "nothing specifiyed"]);
    }else{
        if ($data !== null) {
            // add filter later
            
          
            if($this->others[0] === '0'){
                // $Users->selectWhere('*',"Utilisateurs", "Email = {$data['Email']} AND MotDePasse = {$data['MotDePasse']}");
                $x = $Users->Update("Utilisateurs", $data,"Email = '{$data['Email']}' AND MotDePasse = '{$data['MotDePasse']}'");
              
                if($x === "No rows updated" ){
                    echo "accont not found ";
                    http_response_code(400); 
                }else{
                    echo json_encode($Users->selectWhere("id_user","Utilisateurs","Email = '{$data['Email']}' AND MotDePasse = '{$data['MotDePasse']}'")) ;
                    http_response_code(200); 
                }
            }else{
                $Users->Update("Utilisateurs", $data,"id_user = {$this->others[0]}");

            }
            
        } else {
            echo "Failed to decode JSON data";
        }
    }
}else{
    echo "no perm";
}


?>