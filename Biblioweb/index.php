<?php
$message='';
$books=[];

//Connexion au serveur
$mysqli = @mysqli_connect ('localhost','root','');
//var_dump($mysqli);
//Connexion à la BD
if($mysqli){
    if(mysqli_select_db($mysqli,'Biblioweb')){
        //Reqûete SQL
    $query = "SELECT title FROM books";
    $result = mysqli_query ($mysqli,$query);
    if($result){
        //Extraction des données
        while (($book = mysqli_fetch_assoc($result)) != null){
            $books[] = $book;
        //var_dump($book);
        }
        //Libération de la mémoire du résultat
        mysqli_free_result($result);
    } else {
        $message = "Erreur de requête !";
    }
    } else {
        $message= "Base de données inconnue !";
    }
    //Fermeture de la connexion au serveur
    mysqli_close ($mysqli);
} else {
    $message = "Erreur de connexion !";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioweb</title>
</head>
<body>
    <div><?= $message ?></div>
    <div>
    <form action="traiter.php" method="get">
    <label for="search"><h1>Choisir un livre<h1></label>
    <input type="search" name="search" id="search">
    </form>
    </div>
    <div><?php foreach($books as $book) {?>
        <p><?= $book['title']?></p>
    <?php }?>
    </div>
    
</body>
</html>