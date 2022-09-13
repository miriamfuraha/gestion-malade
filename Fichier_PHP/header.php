<?php
session_start();
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fichier_CSS/malade.css?t=<?php echo time()?>">
    <title>GESTION MALADE</title>
</head>
<body>
<header>
        <h1>G<span>estion Malade</span></h1>
        <nav>
            <h4 href="" class="online"><?php echo $_SESSION['username']?> en ligne <?php echo date("d/m/y")?>   </h4>
            <a href="malade.php">Malade</a>
            <a href="medecin.php">Médecin</a>
            <a href="consulter.php">Consultation</a>
            <a href="medicament.php">Médicamment</a>
            <a href="consommer.php">Consommation</a>
            <a href="chambre.php">Chambre</a>
            <a href="interner.php">Interner</a>
            <a href="agent.php">Agent</a>
            <a href="paiement.php">Paiement</a>
            <a href="deconnexion.php">Déconnexion</a>
        </nav>
    </header>
    <?php }else{
        header("location:accueil.php");
    }
        ?>
    
