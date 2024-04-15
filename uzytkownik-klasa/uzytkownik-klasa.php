<?php

class User {
    //właściowości klasy user czyli "co użytkownik ma"

    private $id;
    private $email;
    private $password;

    //metody klasy user czyli "co uzytkownik robi"


    //konstruktor
    public function __construct(int $id, string $email)
    {
        //this oznacza tworzony właśnie obiekt lub instancje
        $this->id =$id;
        $this->email = $email;
    }

    public static function Register(string $email,string $password) : bool {
        // funkcja rejstruje nowego uzytkownika do bazy
        //funkcja zwraca true jesli sie udalo lub false jesli nie udalo sie
        $db = new mysqli('localhost' , 'root' , '' , 'bazazcms');
        $sql = "INSERT INTO user (email, password) VALUES (?, ?)";
        $q = $db->prepare($sql);
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        $q->bind_param("s", $email , $passwordHash);
        $result = $q->execute();
        return $result;
    }

    public static function Login(string $email, string $password) : bool {
        //funkcja loguje istniejacego uzytkownika do bazy
        //funkcja zwraca false jesli uzytkownika o takim hasle nie istnieje
        $db = new mysqli('localhost' , 'root' , '' , 'bazazcms');
        $sql = "SELECT * FROM user WHERE email = ? LIMIT 1";
        $q = $db->prepare($sql);
        $q->bind_param("s" , $email);
        $q->execute();
        $result = $q->get_result();
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $passwordHash = $row['passwordHash'];
        if(password_verify($password, $passwordHash)) {
            //hasło sie zgadza
            //zapisz dane uzytkownika do sesji
            $user = new User($id, $email);
            $_SESSION['user_id'] = $id;
            return true;

        } else {
            //hasło sie nie zgadza 
            return false;
        }
    }

    public function Logout() {
        //funkcja wylogowuje uzytkownika


    }
}

?>