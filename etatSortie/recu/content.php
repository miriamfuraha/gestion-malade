<?php 
      require '../../Fichier_PHP/pdo.php';
      $id=$_POST['idmalade'];
      $sql="SELECT nomsmalade FROM malade  where idmala=?";
      $req=$pdo->prepare($sql);
      $req->execute([$id]);
      $tab=$req->fetchAll(PDO::FETCH_ASSOC);
      foreach($tab as $data){
            $nomsmalade=$data['nomsmalade'];
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 class="titre">GestionMalade<span>VUHE</span> </h2>
  <header>
  <h2>Reçu paiement <span> Imprimmé le <?= date("d.m.Y h:i") ?></span></h2>
    <h5>Noms malade : <?= $nomsmalade ?></h5>
  </header>   
  <div class="tab">
  <table>
         <thead>
             <tr>
            <th>Montant </th>
              <th> motif</th>
              <th>Date paiement</th>
             </tr>
         </thead>
         <tbody>
      <?php 
       $sql="SELECT * FROM paiement where idmala=?";
        $req=$pdo->prepare($sql);
        $req->execute([$id]);
        $tab=$req->fetchAll(PDO::FETCH_ASSOC);
        foreach($tab as $data){
                ?>
                 <tr>
               <td><?= $montant=$data['montant'] ?> $</td>
               <td><?= $motif=$data['motif'] ?></td>
               <td><?= $datepaiement=$data['datepaiement'] ?></td>
                 </tr>
                 <?php } ?>
             </tbody>
  </table>
  </div> 
</body>
</html>
<style>
    *{
        padding: 0;
        margin: 0;
        font-family: 'Franklin Gothic Medium', 'Times New Roman', Times, serif;
    }
    body{
        padding: 5px;
    }
    .titre{
        background:rgba(128, 128, 128, 0.2);
        padding: 6px;
        margin: 5px 5px;
        display: inline-block;
        border-radius: 6px 3px;
        border: 0.2px solid darkblue;
    }
    .titre span{
        color: green;
        font-size: 1.3em;
    }
    header{
        width: 100%;
    }
    header h2{
        text-align: center;
        margin: 5px 20px;
        border-bottom: 0.2px solid gray;
        font-weight: 100;
        position: relative;
    }
    header h2 span{
        display: inline-block;
        margin-left: 100px;
        color: red;
        font-size: 12px;
        font-weight: 100;
    }
    header h5{
        text-align: center;
        margin: 5px 30px;
        color: blue;
        font-weight: 100;
    }
    .tab{
        margin: 5px 30px;
        border: 0.2px solid black;
    }
    .tab table{
        border-collapse: collapse;
        width: 100%;
    }
    .tab table thead{
        background: rgba(128, 128, 128, 0.2);
        color: black;
    }
    .tab table thead tr th{
        padding: 5px 2px;
    }
    .tab table tbody{
        text-align: center;
    }
    .tab table tbody tr td{
        border: 0.1px solid rgba(128, 128, 128, 0.2);
        padding: 5px 3px;
    }
    .tab table tbody tr:nth-child(even){
    background: rgba(128, 128, 128, 0.1);
    }
</style>