<?php
require 'pdo.php';
$id=$_GET['id'];
$sql="DELETE from  chambre where idchambre=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
if($requete){
    header('location:chambre.php');
}
?>