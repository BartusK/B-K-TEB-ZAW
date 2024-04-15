<?php
class User {
    private $id;
    private $email;
    private $password;


    public function __construct(int $id, string $email )
    {
        $this->id = $id;
        $this->email = $email;
    }



    public static function  Register (string $email,string $password) : bool {
      //funkcja rejestrujaca
       $db = new mysqli('localhost', 'root', '', 'authh');
       $sql = "INSERT INTO user (email,password) VALUES (?,?)";
       $q = $db->prepare($sql);
       $passwordHash = password_hash($password, PASSWORD_ARGON2I);
       $q->bind_param("ss", $email, $passwordHash);
       $result = $q->execute();
       return $result;
    }
    public static function  Login (string $email,string $password) : bool {
      //funkcja logujaca
      $db = new mysqli('localhost', 'root', '', 'authh');
      $sql= "SELECT * FROM user WHERE email = ? LIMIT 1";
      $q = $db->prepare($sql);
      $q -> bind_param("s", $email);
      $q->execute();
      $result = $q->get_result();
      $row = $result->fetch_assoc();
      $id = $row['id'];
      $passwordHash = $row['passwordHash'];
      if(password_verify($password, $passwordHash)){
       
          $user = new User($id, $email);
          $_SESSION['user'] = $user;
          return true;
      }else{
          return false;
      }
      
    }
    public function Logout(){
        //funkcja wylogywywujaca
        
    }

}


?>