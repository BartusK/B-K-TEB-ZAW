<?php

// dostęp
$host = "localhost";
$username = "root";
$password = "ZAQ@wsx123";
$dbname = "baza-memy";

// Łączenie z bazą
$conn = mysqli_connect($host, $username, $password, $dbname);

// Sprawdzanie połączenia
if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Pobieranie danych z formularza html
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


if (mysqli_num_rows($result) > 0) {
    echo "Użytkownik o tej nazwie już istnieje!";
} else {
    // Haszuj hasło
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Zapis danych w bazie
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    mysqli_query($conn, $sql);

    echo "Użytkownik został utworzony pomyślnie!";
}

// Zamykanie połączenia
mysqli_close($conn);

?>

