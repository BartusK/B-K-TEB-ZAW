<?php
session_start();
require("./class/User.class.php");
?>
<?php
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "login"){
    

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$result = User::Login($email, $password);
    if($result){
        echo "Zalogowano poprawnie";
    } else {
        echo "UPS Coś poszło nie tak!";
    }
}
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "register"){
    $db = new mysqli("localhost", "root", "", "authh");
    $email = $_REQUEST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = $_REQUEST['password'];
    $passwordRepeat = $_REQUEST['password'];
    if($password = $passwordRepeat){
    $q = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?)");
    $passwordHash = password_hash($password, PASSWORD_ARGON2I);
    $q->bind_param("ss", $email, $passwordHash);
    $result = $q->execute();
    if($result){
        echo "Konto utworzone poprawnie";
    } else {
        echo "UPS Coś poszło nie tak!";
    }
    } else {
        echo "Hasła nie sa identyczne";
    }
}
// $db = new mysqli("localhost", "root", "", "authh");
// //$q = "SELECT * FROM user WHERE email = '$email'";
// //echo $q;

// $q = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
// $q->bind_param("s", $email,);
// $q->execute();
// $result = $q->get_result();
// $userRow = $result->fetch_assoc();
// if($userRow == null){
//     echo "Błędny login lub hasło <br>";
// } else {
// IF(password_verify($password, $userRow['passwordHash'])){
// echo "Zalogowano poprawnie <br>";
// } else {
// echo "Nieprawidłowy login lub hasło <br>";
// }
// }
// }
// if(isset($_REQUEST['action']) && $_REQUEST['action'] == "register"){
//     $db = new mysqli("localhost", "root", "", "authh");
//     $email = $_REQUEST['email'];
//     $email = filter_var($email, FILTER_SANITIZE_EMAIL);
//     $password = $_REQUEST['password'];
//     $passwordRepeat = $_REQUEST['password'];
//     if($password = $passwordRepeat){
//     $q = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?)");
//     $passwordHash = password_hash($password, PASSWORD_ARGON2I);
//     $q->bind_param("ss", $email, $passwordHash);
//     $result = $q->execute();
//     if($result){
//         echo "Konto utworzone poprawnie";
//     } else {
//         echo "UPS Coś poszło nie tak!";
//     }
//     } else {
//         echo "Hasła nie sa identyczne";
//     }
// }
// //$db->query($q);

// //$d = mysqli_connect("localhost", "root", "", "authh");
// //mysqli_query($d, "SELECT * FROM user");
?>
<h1>Zaloguj sie</h1>
<form action="index.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <input type="hidden" name="action" value="login">
    <input type="submit" value="Zaloguj">
</form>
<h1>Zarajestruj sie</h1>
<form action="index.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
        <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <label for="passwordRepeatInput">Hasło ponowne:</label>
    <input type="password" name="password" id="passwordRepeatInput">
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Zarejestruj">
</form>