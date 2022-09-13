<?php
require 'pdo.php';
$id=$_GET['id'];
$sql="DELETE from  agent where idag=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
if($requete){
    header('location:agent.php');
}
?>