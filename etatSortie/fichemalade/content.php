<?php 
      require '../../Fichier_PHP/pdo.php';
      $id=$_POST['idmalade'];
      $sql="SELECT * FROM malade where idmala=?";
      $requete=$pdo->prepare($sql);
      $requete->execute([$id]);
      $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
      foreach($tab as $data){
          $idmala =$data['idmala'];
          $nommalade=$data['nomsmalade'];
          $etatcivil=$data['etatcivilmala'];
          $datedenaissance=$data['datenaissancemala'];
          $sexe=$data['sexemala'];
          $profession=$data['professionmala'];
          $adresse=$data['adresse'];
          $poids=$data['poidsmala'];
          $taille=$data['taillemala'];
          $temperature=$data['tmala'];
          $fr=$data['frmala'];
          $fc=$data['fcmala'];
          $ta=$data['tamala'];
          $pouls=$data['poulsmala'];
          $numerotelephone=$data['telmala'];
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
    <h2>Fiche de consultation <span> Imprimmée le <?= date("d.m.Y h:i") ?></span></h2>
    <h5>N° Fiche : <?= $idmala ?></h5>

  </header>   
  <div class="tab">
  <table>
             <tr>
              <th>Identification</th>
             </tr>

             <tr>
                <td> Nom malade :</td>
                <td><?= $nommalade ?></td>
             </tr>

             <tr>
                <td> Date de naissance :</td>
                <td><?= $datedenaissance ?></td>
                <td> Sexe :</td>
                <td><?= $sexe ?></td>
                <td> Etat Civil :</td>
                <td><?= $etatcivil ?></td>
                <td>T° :</td>
                <td><?= $temperature ?></td>
             </tr>

             <tr>
             <td> Profession :</td>
                <td><?= $profession ?></td>
                <td> Adresse :</td>
                <td> <?= $adresse ?></td>
                <td>telephone : </td>
                <td><?= $numerotelephone ?></td>
             </tr>
         <tbody>
         <tr>
                    <th>Mesuration</th>
                </tr>
                <tr>
                    <td>Poids : <?= $poids ?></td>
                    <td>Taille :<?= $taille ?></td>
                    <td>TA : <?= $ta ?></td>
                    <td>Fr :<?= $fr ?></td>
                    <td>Fc : <?= $fc ?></td>
                    <td>pouls : <?= $pouls ?></td>
                </tr>
         </tbody>
 </table>
         <table>
                <tr class="main">
                        <th> date consultation</th>
                        <th> Symptome</th>
                        <th> Diagnostic</th>
                </tr>
                <?php
                      $sql="SELECT symptome, diagnostic , dateconsultation from consulter where idmala=?";
                      $requete=$pdo->prepare($sql);
                      $requete->execute([$id]);
                      $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                      foreach($tab as $data){
                          $symptome =$data['symptome'];
                          $diagnostic=$data['diagnostic'];
                          $dateconsultation=$data['dateconsultation'];
                ?>
                 <tr class="main">
                    <td><?= $dateconsultation ?></td>
                    <td><?= $symptome ?></td>
                    <td><?= $diagnostic ?></td>
                 </tr>
    <?php } ?>
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
    .tab table tbody tr {
        border-bottom: 0.1px solid rgba(128, 128, 128, 0.2);
    }
    * td{
        padding: 5px 2px;
        border-bottom: 0.1px solid rgba(128, 128, 128, 0.2);
    }
    .main{
        width: 100%;
    }
    .main th{
        background:  rgba(128, 128, 128, 0.2);
        padding: 5px 2px;
    }
    .main td{
        border: 0.9px solid rgba(128, 128, 128, 0.2);
    }
</style>