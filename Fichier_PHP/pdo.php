<?php
$user="root";
$pass="";
try {
    $pdo=new PDO('mysql:host=localhost;dbname=gestionmalade',$user,$pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>