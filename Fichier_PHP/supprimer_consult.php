<?php
require 'pdo.php';
$id=$_GET['id'];
$sql="DELETE from  consulter where idconsulter=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
if($requete){
    header('location:consulter.php');
}
?>