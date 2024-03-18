<?php
if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){

}
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$db = new mysqli("localhost", "root", "", "authh"); 

$q = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
$q->bind_param("s", $email);
$q->execute();
$result = $q->get_result();
$userRow = $result->fetch_assoc();
var_dump($userRow);


?>
<h1>Zarajestruj sie</h1>
<form action="index.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <input type="submit" value="Zarejestruj">
</form>