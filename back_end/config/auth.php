<?php

require_once("database.php");

class Auth{


private $dbcon;
private $state;
private $errmsg;




    public function __construct(){
    try{
        $db = new Database();
        if($db->getState()){
            $this->dbcon = $db->getDb();
            $this->state = true;
            $this->errmsg = "Connected";

        }else{
            $this->state = false;
            $this->errmsg = $db->getErrMsg();
        }
    }
    catch(Exception $e){
             $this->state = false;
             $this->errmsg = $e->getMessage();
    }

    }

    
    public function Auth_Check($user){

        $sql = ("CALL im_proj.auth_check(:username)");
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        $usr = $stmt->fetch(PDO::FETCH_ASSOC);

 
            if ($usr) {
                
                  $row = array();
                  $row = $usr;
                //  var_dump($row );
                return $row;
            } else {                  
                return array();                    
            }
      
           
    }



 
    public function Logged_In_User($uid){

        $sql = "CALL get_one(:user_id)";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':user_id', $uid);
        
            try {
                $stmt->execute();
                $usr =  $stmt->fetch(PDO::FETCH_ASSOC);
                if($stmt){
                    $row = array();
                    $row = $usr;
                    var_dump($row);
                    return $row;
                    
                }else{
                    return array();
                    
                }
            } catch (PDOException $ex) {
                $this->state = false;
                return $ex->getMessage();
                http_response_code(401);
                    echo json_encode(['error' => 'Authentication failed']);
            }
    }


   
    
    



    
    




}




?>