<?php
require 'pdo.php';
$id=$_GET['id'];
$sql="DELETE from  medicament where idmedi=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
if($requete){
    header('location:medicament.php');
}
?>