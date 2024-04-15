<?php
//włącz obsługę sesji w tym pliku
session_start();
//zaimportuj definicje klasy
require("./class/User.class.php");
?>


<?php if(isset($_REQUEST['email']))  ?>

<?php

$email = $_REQUEST['email'];
if($_REQUEST['password'] != $_REQUEST['passwordRepeat'])
die("Hasła niezgodne");
$password = $_REQUEST['password'];
$passwordHash = password_hash($passwd, PASSWORD_ARGON2I);

$email = filter_var($email, FILTER_SANITIZE_EMAIL);

$db = new mysqli("localhost", "root" , "", "bazazcms");

$sql = "INSERT INTO user (email, password) VALUES (?, ?)";
$q = $db->prepare($sql);
//ręcznie
//$q = "SELECT * FROM user WHERE email = '$email'";
//$db->query("SELECT * FROM user WHERE email = '$email");
//echo $q;

//auto
$q = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
$q->bind_param("s", $email , $passwordHash);
$success = $q->execute();
if(!$success)
    die("Bład przy próbie założenia konta");

//$q->execute();
//$result = $q->get_result();
//
//$userRow = $result->fetch_assoc();
//if($userRow == null)
//var_dump($userRow);


//inny rodzaj polaczenia 
//$d = mysqli_connect("localhost", "root" , "", "bazazcms");

//$passwd = "tajneHaslo";
//$hash = password_hash($passwd,PASSWORD_ARGON2I);
//echo $hash;

?>

<form action="register.php" method="get">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <input type="submit" value="Zaloguj">
</form>