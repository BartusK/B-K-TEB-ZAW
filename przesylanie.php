<?php
if(!empty($_POST)) {
    //cos poszlo postem
    $postTitle = $_POST['postTtile'];
    $postDescription = $_POST['postDescription'];
    //wgrywanie pliku 
    //zdefiniuj folder docelowy
    $targetDirectory = "img/";
    //użyje orginalnej nazwy pliku 
    //$fileName = $_FILES['file'] ['name'];
    //modyfikacja użyj shahs256
    $fileName = hash('sha256', $FILES['file']['name'].microtime());
    //przesuń plik z lokazlizacji tymczasowej do docelowej 
    //move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory.$fileName);
    //zmiana - użyj imagewebp do zapisania

    //po 1!: wczytaj 
    $gdImage = imagecreatefromgd($_FILES['file']['tmp_name']);

    //przygotuj pełny url pliku
    $finalUrl - "http://localhost/cms/img/" .$fileName.".webp.";

    //po 2! 
    imagewebp($gdImage, $finalUrl);

    //dopisz posta do bazy
    $authorID = 1;
    $imageUrl = "localhost/cms/img" . $fileName;

    $db = new mysqli('localhost' , 'root' , '' ,'cms');
    $q = $db->prepare("INSERT INTO post (author, imgUrl, title) VALUES (?,?,?)");
    //pierwszy atrybut jest liczba ,dwa pozostałe tekstem wiec integer
    $q->bind_param("iss", $authorID, $imageUrl, $postTitle);
    $q->execute();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj nowy post</title>
</head>
<body>
    <from action="upload.php" method="post" encttype="multipart/from-data">
        <label for="postTitleInput">Tytuł posta:</label>
        <input type="text" name="postTitle" id="postTitleInput">
        <br>
        <label for="postDescriptionInput">Opis posta:</label>
        <input type="text" name="postDescription" id="postDescriptionInput">
        <br>
        <label for="fileInput">Obrazek:</label>
        <input type="file" name="file" id="fileInput">
        <br>
        <input type="submit" value="Wyślij!">
</body>
</html>