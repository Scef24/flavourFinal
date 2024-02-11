<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../object/user.php");
require_once("../config/auth.php");
require_once("session.php");



$method = isset($_POST['method']) ? $_POST['method'] : exit();
  
if(function_exists($method)){
    call_user_func($method);
}else{
    exit();
}



function Save_User(){
    
    $username = isset($_POST['username']) ? $_POST['username'] : '0';
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $securityQuestion = isset($_POST['securityQuestion']) ? $_POST['securityQuestion']:'';
    $securityAnswer = isset($_POST['securityAnswer']) ? $_POST['securityAnswer']:'';
 
   $hased_password = password_hash($password, PASSWORD_DEFAULT);



   $user = array(
    "username" =>$username,
    "fname"=>$fname ,
    "lname"=>$lname ,
    "password"=>$hased_password,  
    "securityQuestion"=>$securityQuestion,
    "securityAnswer"=>$securityAnswer,
);

   $usr = new User();
   $check =  $usr->Register_Check($user);

   
   
   if($check){

    echo json_encode(0);

   }else if(!$check){
    $ret = $usr->Insert_User($user);
    echo json_encode(1);

   }


  

}





function Display_Auth(){
   
    var_dump($_SESSION['user'] );

}
function Change_Auth(){
    var_dump($_SESSION['user'] );

}


function Current_Auth(){

    echo json_encode($_SESSION['user']);

}


function Log_In(){

    $username = isset($_POST['username']) ? $_POST['username'] : 0;
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    $hased_password = password_hash($password, PASSWORD_DEFAULT);



    $auth = new Auth();
    $ret = $auth->Auth_Check($username);
    
    if(password_verify($password, $ret['password'])){

        if($ret['status'] == "banned"){
            echo json_encode(0);


        }else{
            $_SESSION['user'] = $ret;
            echo json_encode($_SESSION['user']);

        }
    }


}

function Logout(){
    var_dump("WORKING");
    session_destroy();
}

function Reset_Password() {
    try {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $securityQuestion = isset($_POST['securityQuestion']) ? $_POST['securityQuestion'] : '';
        $securityAnswer = isset($_POST['securityAnswer']) ? $_POST['securityAnswer'] : '';
        $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';
        $confirmNewPassword = isset($_POST['confirmNewPassword']) ? $_POST['confirmNewPassword'] : '';
        
        error_log('Binding Parameters:');
        error_log('Username: ' . $username);
        error_log('Security Question: ' . $securityQuestion);
        error_log('Security Answer: ' . $securityAnswer);
        error_log('New Password: ' . $newPassword);
        error_log('Confirm New Password: ' . $confirmNewPassword);
     

        $user = new User(); 

       
        $sql = "CALL im_proj.reset_password(:username, :securityQuestion, :securityAnswer, :newPassword, :confirmNewPassword, @p_result)";
        $stmt = $user->getDbcon()->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':securityQuestion', $securityQuestion);
        $stmt->bindParam(':securityAnswer', $securityAnswer);
        $stmt->bindParam(':newPassword', $newPassword);
        $stmt->bindParam(':confirmNewPassword', $confirmNewPassword);

        error_log('SQL Query: ' . $sql);
        
        $stmt->execute();

      
        $stmt->closeCursor(); 
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

       
        if ($result !== false && isset($result['@p_result'])) {
          
            if ($result['@p_result'] === 1) {
             
                echo json_encode(['success' => true]);
            } elseif ($result['@p_result'] === -1) {
            
                echo json_encode(['success' => false, 'error' => 'Incorrect security question or answer.']);
            } elseif ($result['@p_result'] === -2) {
              
                echo json_encode(['success' => false, 'error' => 'New passwords do not match.']);
            } else {
               
                echo json_encode(['success' => false, 'error' => 'Failed to reset password.']);
            }
        } else {
          
            echo json_encode(['success' => false, 'error' => 'Failed to reset password.']);
        }
    } catch (Exception $e) {
     
        error_log('Exception caught: ' . $e->getMessage(), 0);
        echo json_encode(['success' => false, 'error' => 'An unexpected error occurred.']);
    }
}







function getAllUsers(){
   
    
    $usr = new User();
    echo json_encode($usr->displayAllUsers());
    
}

function Get_All_Admins(){
   
    
    $usr = new User();
    echo json_encode($usr->Get_All_Admins());
    
}

function Search_Users(){
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $usr = new User();
    echo json_encode($usr->Search_Users($search));
}

function Search_Admins(){
    $Asearch = isset($_POST['Asearch']) ? $_POST['Asearch'] : '';
    
    $usr = new User();
    echo json_encode($usr->Search_Admins($Asearch));
}

function Change_Role(){
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;

    $usr = new User();
    $usr->Change_Role($user_id);
    var_dump($user_id . "this");
 

}


function Change_Status(){
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;

    $usr = new User();
    $usr->Change_Status($user_id);
    var_dump($user_id . "this");
 

}

function Change_Account_ID(){
    
    $account_id = isset($_POST['account_id']) ? $_POST['account_id'] : 0;

    $user = array(
        "user_id" => $_SESSION['user']["user_id"],
        "account_id" =>$account_id,
        
    );


    $usr = new User();
    $check =  $usr->Cred_Check($_SESSION['user']["user_id"]);
    $usr->Change_Account_ID($user);

    if($account_id == $check["account_id"]){
       
        echo json_encode(0);

    }else{
        $_SESSION['user']["account_id"] = $account_id;
         echo json_encode(1);
 
    }
 

}


function Change_Name(){
    
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';

    $user = array(
        "user_id" => $_SESSION['user']["user_id"],
        "first_name" =>$first_name,
        "last_name"=>$last_name,
    );

    $usr = new User();
    $check =  $usr->Cred_Check($_SESSION['user']["user_id"]);
    $usr->Change_Name($user);

    if($first_name == $check["first_name"] && $last_name == $check["last_name"]){
       
        echo json_encode(0);

    }else{
        $_SESSION['user']["first_name"] = $first_name;
        $_SESSION['user']["last_name"] =  $last_name;
 
         echo json_encode(1);
 
    }
}

function Change_Password(){
    
    $password = isset($_POST['password']) ? $_POST['password'] : 0;
    $Cpassword = isset($_POST['Cpassword']) ? $_POST['Cpassword'] : 0;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $user = array(
        "user_id" => $_SESSION['user']["user_id"],
        "password" => $hashed_password,
        
    );


    $usr = new User();
    $check =  $usr->Cred_Check($_SESSION['user']["user_id"]);
    $usr->Change_Password($user);

   

    if(!password_verify($Cpassword, $check["password"])){
       
        echo json_encode(-1);
    }else if(password_verify($password, $check["password"])){    

        echo json_encode(0);

    }else{
        $_SESSION['user']["password"] = $hashed_password;
         echo json_encode(1);
 
    } 
}










?>