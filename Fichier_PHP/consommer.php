<?php require 'header.php';
error_reporting(0);
require "pdo.php";
     $enregistrer=$_POST['enregistrer'];
     $actualiser=$_POST['actualiser'];       
?>

   
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>Consommation</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms malade</label> <br>
                    <select name="idmalade">
                        <?php
                        $sql="SELECT idmala, nomsmalade FROM malade";
                        $requete=$pdo->prepare($sql);
                        $requete->execute();
                        $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                        foreach($tab as $data){
                            $idmala=$data['idmala'];
                            $nomsmalade=$data['nomsmalade'];
                           
                        ?>
                        <option value="<?php echo $idmala?>"><?php echo $idmala . " ".$nomsmalade?></option>
                        <?php
                        }
                         ?>
                    </select>
                    </div>
                    <div class="item">
                    <label for="">Nom médicament</label> <br>
                    <select name="idmedi">
                        <?php
                        $sql="SELECT idmedi, designationmedi FROM medicament";
                        $requete=$pdo->prepare($sql);
                        $requete->execute();
                        $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                        foreach($tab as $data){
                            $idmedi=$data['idmedi'];
                            $designationmedi=$data['designationmedi'];
                           
                        ?>
                        <option value="<?php echo $idmedi?>"><?php echo $idmedi . " ".$designationmedi?></option>
                        <?php
                        }
                         ?>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Quantité consommée</label> <br>
                    <input type="text" name="quantite" placeholder="quantité consommée">
                    </div>
                    <div class="item">
                    <label for="">Date Consommation</label> <br>
                    <input type="date" name="dateconsommation">
                    </div>
                </div>
                <div class="btn">
                <button type="submit" name="enregistrer">Enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php
                 $idmalade=$_POST['idmalade'];
                 $idmedi=$_POST['idmedi'];
                 $quantite= $_POST['quantite'];
                 $dateconsommation=$_POST['dateconsommation'];
                if (isset($enregistrer)){
                     if ((!empty($idmalade))&& 
                         (!empty($idmedi))&&
                         (!empty($quantite)) && 
                         (!empty($dateconsommation))
                        )
                        {
                $sql="INSERT INTO   consommer(idmala,idmedi,qteconsom,
                dateconsom) values (:idmala,:idmedi,:qteconsom,:dateconsom)";
                $requette=$pdo->prepare($sql);
                $requette->execute([
                    ':idmala'=> $idmalade,
                    ':idmedi'=> $idmedi,
                    ':qteconsom'=>$quantite,
                    ':dateconsom'=>$dateconsommation
                ]);
                if($requette){?>
                    <script>
                        alert("enregistrement reussi")
                    </script>
                        <?php
                    }

                }else{?>
                    <script>
                        alert("champs laissé vide")
                    </script>
                    <?php
                }
        }
                    
                
                ?>
                </div>
            </form>
    </div>
    <div class="droite">
        <form action="" method="post">
                <!-- <input type="text" name="recherche" placeholder="rechercher un malade">
                <button type="submit" name="recherche">Recherche</button>
                <a class="im" href="etudiantPDF/pdf.php">imprimer</a> -->
        </form>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID consommation</th>
                        <th>Noms malade</th>
                        <th>Noms médicament</th>
                        <th>Quantité consommée   </th>
                        <th>Date consommation</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                    $sql="SELECT consommer.idconsommer, malade.nomsmalade,medicament.designationmedi,consommer.qteconsom,consommer.dateconsom FROM consommer, malade,medicament WHERE malade.idmala=consommer.idmala AND medicament.idmedi=consommer.idmedi";
                    $requete=$pdo->prepare($sql);
                    $requete->execute();
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idconsommer=$data['idconsommer'];
                        $nomsmalade=$data['nomsmalade'];
                        $designationmedi=$data['designationmedi'];
                        $quantite=$data['qteconsom'];
                        $dateconsommation=$data['dateconsom'];

                        ?> 
                        <td><?php echo $idconsommer?></td>
                        <td><?php echo $nomsmalade?></td>
                        <td><?php echo $designationmedi?></td>
                        <td><?php echo $quantite?></td>
                        <td><?php echo $dateconsommation?></td>
                        
                        
                        <td><a href="modifier_consommer.php?id=<?php echo $idconsommer?>">modifier</a></td>
                        <td><a href="supprimer_consommer.php?id=<?php echo $idconsommer?>">supprimer</a></td>
                        
                        </tr>
                            <?php   
                }
                    ?>                    
                </tbody>
            </table>
    </div>
    </main>
</body>
</html>