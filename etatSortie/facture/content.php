<?php 
      require '../../Fichier_PHP/pdo.php';
      $id=$_POST['idmalade'];

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
    <h2>FACTURE <span> Imprimmée le <?= date("d.m.Y h:i") ?></span></h2>
    <?php 
    $sql= "SELECT  nomsmalade from malade where idmala=?";
    $req=$pdo->prepare($sql);
    $req->execute([$id]);
    $tab=$req->fetchALL(PDO::FETCH_ASSOC);
    foreach($tab as $data){
        $malade=$data['nomsmalade'];
    }
    ?>
    <h5>Noms malade :  <?= $malade ?></h5>
  </header>   
  <div class="tab">
  <table>
             <tr>
              <th>Medicament consommer</th>
             </tr>
             <tr>
                <td> designation</td>
                <td> Quantite</td>
                <td> Prix unitaire</td>
                <td>prix total</td>
             </tr>
             <?php 
              $sql= "SELECT  medicament.designationmedi, medicament.pumedi , consommer.qteconsom , round(medicament.pumedi *consommer.qteconsom,3) as prix_total from consommer,medicament WHERE consommer.idmedi= medicament.idmedi and consommer.idmala=?";
              $req=$pdo->prepare($sql);
              $req->execute([$id]);
              $tab=$req->fetchALL(PDO::FETCH_ASSOC);
              foreach($tab as $data){
                  $designationmedi=$data['designationmedi'];
                  $qteconsom=$data['qteconsom'];
                  $pumedi=$data['pumedi'];
                  $prix_total=$data['prix_total'];
             ?>
             <tr>
             <td> <?= $designationmedi ?></td>
             <td> <?= $qteconsom ?></td>
             <td> <?= $pumedi ?> $</td>
             <td> <?= $prix_total ?> $</td>
             </tr>
             <?php } ?>
         <tbody>
                <tr>
                    <th>Hospitalisation</th>
                </tr>

                <tr>
                    <td>chambre</td>
                    <td>date d'admission</td>
                    <td>date sortie</td>
                    <td>prix chambre</td>
                </tr>
                <?php
                $sql= "SELECT interner.dateentree, interner.datesortie , DATEDIFF(interner.datesortie, interner.dateentree) as datediff, chambre.designationchambre, chambre.prixchambre, (DATEDIFF(interner.datesortie, interner.dateentree) * chambre.prixchambre) as prix_chambre from interner, chambre WHERE interner.idchambre= chambre.idchambre and interner.idmala=?";
              $req=$pdo->prepare($sql);
              $req->execute([$id]);
              $tab=$req->fetchALL(PDO::FETCH_ASSOC);
              foreach($tab as $data){
                  $designationchambre=$data['designationchambre'];
                  $dateentree=$data['dateentree'];
                  $datesortie=$data['datesortie'];
                  $prixchambre=$data['prixchambre'];
             ?>
                 <tr>
             <td> <?= $designationchambre ?></td>
             <td> <?= $dateentree ?></td>
             <td> <?= $datesortie ?> </td>
             <td> <?= $prixchambre ?> $</td>
             </tr>
             <?php } ?>
              <tr>
                 <th> --------------------------</th>
              </tr>
              <tr>
                <td>Jour hospitalié</td>
                <td>A payer</td>
                <td> <?= "     " ?></td>
             
              </tr>
                    <?php
             foreach($tab as $data){
                  $datediff=$data['datediff'];
                  $prix_chambre=$data['prix_chambre'];
                  $datesortie=$data['datesortie'];
                  $prixchambre=$data['prixchambre'];
             ?>
                 <tr>
             <td> <?= $datediff ?>Jours</td>
             <td> <?= $prix_chambre ?>$</td>
             <td> <?= "     " ?></td>
             </tr>
             <?php } ?>
             <tr>
                <th></th>
                <th></th>
                <th></th>
                <th> MONTANT A PAYER  </th>
             </tr>
             <td></td>
             <td></td>
             <td></td>
             <td class="fin"> <?= @$prix_chambre +  @$prix_total?>$</td>
             </tbody>
  </table>
  </div> 
</body>
</html>
<style>
    .fin{
        background: gray;
        color: white;
    }
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
        padding: 20px;
        margin: 5px 5px;
        display: inline-block;
        border-radius: 6px 3px;
        border: 0.2px solid green;
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
        margin: 5px 30px;
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
    }
    .tab table tbody tr:nth-child(even){
    background: rgba(128, 128, 128, 0.1);
    }
</style>