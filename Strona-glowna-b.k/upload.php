<?php
if(!empty($_POST)) {
    //cos poszlo postem
    $postTitle = $_POST['postTtile'];
    $postDescription = $_POST['postDescription'];
    //wgrywanie pliku 
    //zdefiniuj folder docelowy
    $targetDirectory = "img/";
    //użyje orginalnej nazwy pliku 
    $fileName = $_FILES['file'] ['name'];
    //przesuń plik z lokazlizacji 
    move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory.$fileName);
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