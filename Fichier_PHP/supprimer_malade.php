<?php
require 'pdo.php';
$id=$_GET['id'];
$sql="DELETE from  malade where idmala=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
if($requete){
    header('location:malade.php');
}
?>