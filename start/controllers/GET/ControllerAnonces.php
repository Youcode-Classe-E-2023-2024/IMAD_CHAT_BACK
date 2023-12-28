<?php

// echo "<br>". "controoooooooooolerpassed" . "<br>";
if(isset($this->autorisation) && $this->autorisation === 1){
    
  if(empty($this->others)){
  
    http_response_code(200);
    echo json_encode($Anonce->selectAll("Articles"));


}else{
  // mn b3d add token mnin jaya request specify user cant fetch data other then his own


    http_response_code(200);
    echo json_encode($Anonce->selectWhere("*","Articles","ArticleID = {$this->others[0]}"));


}


}else{
  
    echo "no autorisation";  
}
