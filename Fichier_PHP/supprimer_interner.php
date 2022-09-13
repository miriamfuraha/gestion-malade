<?php
require 'pdo.php';
$id=$_GET['id'];
$sql="DELETE from  interner where idinterner=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
if($requete){
    header('location:interner.php');
}
?>