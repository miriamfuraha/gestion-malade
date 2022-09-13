<?php
require 'pdo.php';
$id=$_GET['id'];
$sql="DELETE from  consommer where idconsommer=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
if($requete){
    header('location:consommer.php');
}
?>