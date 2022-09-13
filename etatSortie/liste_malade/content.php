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
    <h2>LISTE DE MALADE</h2>
    <h5> Imprimmée le <?= date("d.m.Y h:i") ?></h5>
  </header>   
  <div class="tab">
  <table>
         <thead>
             <tr>
             <th>ID</th>
            <th> Noms malade</th>
            <th>Date naissance </th>
              <th> Etat civil</th>
              <th>Genre</th>
               <th>Profession</th>
               <th>Adresse </th>
               <th>telephone</th>
             </tr>
         </thead>
         <tbody>
      <?php 
      require '../../Fichier_PHP/pdo.php';
       $sql="SELECT * FROM malade";
        $req=$pdo->prepare($sql);
        $req->execute();
        $tab=$req->fetchAll(PDO::FETCH_ASSOC);
        foreach($tab as $data){
         ;
                ?>
                 <tr>
               <td><?= $idmala=$data['idmala'] ?></td>
               <td><?= $nomsmalade=$data['nomsmalade'] ?></td>
               <td><?= $datenaissancemala=$data['datenaissancemala'] ?></td>
               <td><?= $etatcivilmala=$data['etatcivilmala'] ?></td>
               <td><?= $sexemala=$data['sexemala'] ?></td>
               <td><?= $professionmala=$data['professionmala'] ?></td>
               <td><?=   $adresse=$data['adresse'] ?></td>
               <td><?= $telmala=$data['telmala'] ?></td>
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
    }
    header h5{
        text-align: center;
        margin: 5px 30px;
        color: red;
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
    }
    .tab table tbody tr:nth-child(even){
    background: rgba(128, 128, 128, 0.1);
    }
</style>