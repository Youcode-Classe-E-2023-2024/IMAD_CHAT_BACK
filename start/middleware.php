<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
class Heart {
    public $Method;
    public $url;
    public $others;
    private $autorisation = 0;
    public $senderid;
    public function __construct() {
        $this->Url();
        // var_dump($this->url);
         if(!isset($this->url[5]) || !isset($this->Method)){
            http_response_code(502); // 3jbatni 5
            echo json_encode(["message" => "url or method anothorized"]);
            return;
         }
        
         $headers = getallheaders();


  

            
             if(file_exists("controllers/{$this->Method}/Controller{$this->url[5]}" . '.php')){

                for ($i = 6; $i < count($this->url); $i++) {
                    $this->others[] = $this->url[$i];
                }
                $body = file_get_contents("php://input");
                $data = json_decode($body, true);

                $this->autorisation = 1;
                require_once "controllers/{$this->Method}/Controller{$this->url[5]}.php";       

            }else{
                echo 'not found dyl imad';
                http_response_code(403); 
            }

         

        
    }

    public function Url() {
        $url = rtrim($_SERVER['REQUEST_URI'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode("/", $url);

        http_response_code(201);
        $this->url = $url;
        $this->Method = $_SERVER['REQUEST_METHOD'];
    }

}

$try = new Heart();
