<?php
require 'pdo.php';
$id=$_GET['id'];
$sql="DELETE from  medecin where idmed=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
if($requete){
    header('location:medecin.php');
}
?>