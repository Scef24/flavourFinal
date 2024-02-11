<?php 
  require_once("../config/database.php");

class User{
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
    
    public function getState(){
        return $this->state;
    }
    public function getDbcon() {
        return $this->dbcon;
    }

  
    
        public function resetPassword($username, $newPassword, $securityQuestion, $securityAnswer) {
         
            $p_result = 0;
    
        
            $sql = "CALL flavour.reset_password(:username, :securityQuestion, :securityAnswer, :newPassword, :confirmNewPassword, @p_result)";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':securityQuestion', $securityQuestion);
            $stmt->bindParam(':securityAnswer', $securityAnswer);
            $stmt->bindParam(':newPassword', $newPassword);
            $stmt->bindParam(':confirmNewPassword', $newPassword); // Assuming you want to use this parameter in the stored procedure
    
          
            $stmt->execute();
    
            
            $result = $this->getOutputParameter($stmt, '@p_result');
    
            if ($result === 1) {
              
                return true;
            } elseif ($result === -1) {
              
                return -1;
            } elseif ($result === -2) {
              
                return -2;
            } else {
               
                return false;
            }
        }
    
       
        private function getOutputParameter($stmt, $parameterName) {
            $stmt->closeCursor(); 
            $stmt = $this->dbcon->prepare("SELECT $parameterName AS param");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result['param'];
        }
    
 


    public function Insert_User($user){
        $sql = "call insert_user(:username,:fname,:lname,:password,:securityQuestion,:securityAnswer)";

        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':username',$user['username']);
        $stmt->bindParam(':fname',$user['fname']);
        $stmt->bindParam(':lname',$user['lname']);
        $stmt->bindParam(':password',$user['password']);
        $stmt->bindParam(':securityQuestion', $user['securityQuestion']);
        $stmt->bindParam(':securityAnswer',$user['securityAnswer']);
       
        try{
            $stmt->execute();
            if($stmt){
                return 1;
            }else{
                return 0;
            }
        }catch(Exception $ex){
            
            $this->errmsg = $ex->getMessage();
            echo $ex->getMessage();
            return -1;
            http_response_code(401);
            echo json_encode(['error' => 'Authentication failed']);  
            return array();            
            exit;   
        }

    }
    public function checkSecurityAnswer($username, $securityAnswer)
    {
       
        $p_result = 0;
    
        
        $sql = "CALL flavour.check_security_answer(:username, :securityAnswer, :p_result)";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':securityAnswer', $securityAnswer);
        $stmt->bindParam(':p_result', $p_result, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4); // 4 is the length of INT
    
        try {
          
            $stmt->execute();
            $result = $p_result;
    
         
            if ($result === 1) {
             
                return true;
            } else {
              
                return false;
            }
        } catch (Exception $ex) {
            $this->errmsg = $ex->getMessage();
            return false;
        }
    }
    
    public function getUserData($username)
{
    $sql = "CALL flavour.get_user_data(:username, @user_id, @username_result, @security_question, @security_answer)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->bindParam(':username', $username);


    $user_id = null;
    $username_result = null;
    $security_question = null;
    $security_answer = null;

    try {
        $stmt->execute();

 
        $stmt->bindParam('@user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam('@username_result', $username_result, PDO::PARAM_STR);
        $stmt->bindParam('@security_question', $security_question, PDO::PARAM_STR);
        $stmt->bindParam('@security_answer', $security_answer, PDO::PARAM_STR);


        $stmt->fetch(PDO::FETCH_ASSOC);

     
        if (!$user_id) {
            
            error_log("User not found for username: $username");
            return false;
        }


        return compact('user_id', 'username_result', 'security_question', 'security_answer');
    } catch (Exception $ex) {

        error_log("Error fetching user data: " . $ex->getMessage());
        return false;
    }
}




    public function updatePassword($username, $newPassword, $securityQuestion, $securityAnswer)
    {
       
        if ($this->checkSecurityAnswer($username, $securityAnswer)) {
           
            $sql = "CALL flavour.update_password(:username, :newPassword, :securityQuestion, :securityAnswer)";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':newPassword', $newPassword);
            $stmt->bindParam(':securityQuestion', $securityQuestion);
            $stmt->bindParam(':securityAnswer', $securityAnswer);
    
            try {
                $stmt->execute();
                return $stmt->rowCount();
            } catch (Exception $ex) {
                $this->errmsg = $ex->getMessage();
                return 0;
            }
        } else {
          
            return -1;
        }
    }


    

    public function Cred_Check($user){
        
        $sql = ("CALL flavour.cred_check(:user_id)");
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':user_id', $user);
        $stmt->execute();
        $usr = $stmt->fetch(PDO::FETCH_ASSOC);

 
            if ($usr) {
                
                  $row = array();
                  $row = $usr;
             
                return $row;
            } else {      
                http_response_code(401);
                echo json_encode(['error' => 'Authentication failed']);  
                return array();            
                exit;   
            }
    }

    public function Register_Check($user){
        
        $sql = ("CALL flavour.register_check(:username, :fname, :lname)");
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':username', $user["username"]);
        $stmt->bindParam(':fname', $user["fname"]);
        $stmt->bindParam(':lname', $user["lname"]);
        $stmt->execute();
        $usr = $stmt->fetch(PDO::FETCH_ASSOC);

 
            if ($usr) {       
                  $row = array();
                  $row = $usr;
            
                return $row;
            } else {      
                return array();            
                exit;   
            }




    }


    public function displayAllUsers(){
        $sql = "call get_all_users()";

        $stmt = $this->dbcon->prepare($sql);
            try {
                $stmt->execute();
                if($stmt){
                    $rows = array();
                    while($rw = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $rows[] = $rw;
                    }
                    return $rows;
                }else{
                    return array();
                }
            } catch (PDOException $ex) {
                $this->state = false;
                return $ex->getMessage();
            }
    }


    public function Get_All_Admins(){
        $sql = "call get_all_admins()";

        $stmt = $this->dbcon->prepare($sql);
            try {
                $stmt->execute();
                if($stmt){
                    $rows = array();
                    while($rw = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $rows[] = $rw;
                    }
                    return $rows;
                }else{
                    return array();
                }
            } catch (PDOException $ex) {
                $this->state = false;
                return $ex->getMessage();
            }

    }



    public function Search_Users($user){
        $sql = "call flavour.search_users(:name)";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':name', $user);

            try {
                $stmt->execute();
                if($stmt){
                    $rows = array();
                    while($rw = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $rows[] = $rw;
                    }
                    return $rows;
                }else{
                    return array();
                }
            } catch (PDOException $ex) {
                $this->state = false;
                return $ex->getMessage();
            }
    }


    
    public function Search_Admins($user){
        $sql = "call flavour.search_admins(:name)";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':name', $user);

            try {
                $stmt->execute();
                if($stmt){
                    $rows = array();
                    while($rw = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $rows[] = $rw;
                    }
                    return $rows;
                }else{
                    return array();
                }
            } catch (PDOException $ex) {
                $this->state = false;
                return $ex->getMessage();
            }
    }

  




    public function Change_Role($user){
        var_dump($user);
        $sql = "call flavour.change_role(:user_id)";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':user_id', $user);

        try{
            $stmt->execute();
            if($stmt){
                return 1;
            }else{
                return 0;
            }
        }catch(Exception $ex){
            $this->errmsg = $ex->getMessage();
            echo $ex->getMessage();
            return -1;
        }
    }


    
    public function Change_Status($user){
        var_dump($user);
        $sql = "call flavour.change_status(:user_id)";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':user_id', $user);

        try{
            $stmt->execute();
            if($stmt){
                return 1;
            }else{
                return 0;
            }
        }catch(Exception $ex){
            $this->errmsg = $ex->getMessage();
            echo $ex->getMessage();
            return -1;
        }
    }

    public function Change_Account_id($user){
        
        $sql = "call flavour.update_account_id(:user_id, :account_id)";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':user_id', $user['user_id']);
        $stmt->bindParam(':account_id', $user['account_id']);

        try{
            $stmt->execute();
            if($stmt){
                return 1;
            }else{
                return 0;
            }
        }catch(Exception $ex){
            $this->errmsg = $ex->getMessage();
            echo $ex->getMessage();
            return -1;
        }


    }

    public function Change_Name($user){
       
        $sql = "call flavour.update_name(:user_id, :first_name, :last_name )";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':user_id', $user['user_id']);
        $stmt->bindParam(':first_name', $user['first_name']);
        $stmt->bindParam(':last_name', $user['last_name']);

        try{
            $stmt->execute();
            if($stmt){
                return 1;
            }else{
                return 0;
            }
        }catch(Exception $ex){
            $this->errmsg = $ex->getMessage();
            echo $ex->getMessage();
            return -1;
        }


    }

    public function Change_Password($user){
       
        $sql = "call flavour.update_password(:user_id, :password)";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindParam(':user_id', $user['user_id']);
        $stmt->bindParam(':password', $user['password']);

        try{
            $stmt->execute();
            if($stmt){
                return 1;
            }else{
                return 0;
            }
        }catch(Exception $ex){
            $this->errmsg = $ex->getMessage();
            echo $ex->getMessage();
            return -1;
        }



        

    }












}





?>