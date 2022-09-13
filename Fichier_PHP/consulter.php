
<?php require 'header.php';
require "pdo.php";
error_reporting(0);
$enregistrer=$_POST['enregistrer'];
$actualiser=$_POST['actualiser'];
$erreur=$_GET['erreur'];
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>CONSULTATION</h3><hr></br>
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
                    <label for="">Noms médecin</label>
                    <select name="idmedecin">
                    <?php
                        $sql="SELECT idmed ,nomsmed FROM medecin";
                        $requete=$pdo->prepare($sql);
                        $requete->execute();
                        $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                        foreach($tab as $data){
                            $idmed=$data['idmed'];
                            $nomsmed=$data['nomsmed'];
                           
                        ?>
                        <option value="<?php echo $idmed?>"><?php echo $idmed . " ".$nomsmed?></option>
                        <?php
                        }
                         ?>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Date Consultation</label> <br>
                    <input type="date" name="dateconsultation">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Symptomes</label><br>
                    <textarea name="symptome">symptome</textarea>
                </div>
                    <div class="item">
                    <label for="">Diagnostic</label><br>
                    <textarea name="diagnostic">diagnostic</textarea>
                    </div>
                </div>
                <div class="btn">
                <button type="submit" name="enregistrer">Enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php                
                $idmalade=$_POST['idmalade'];
                $idmedecin=$_POST['idmedecin'];
                $dateconsultation=$_POST['dateconsultation'];
                $symptome=$_POST['symptome'];
                $diagnostic=$_POST['diagnostic'];
                    if(isset($enregistrer)){
                        if((!empty($idmalade)) &&
                        (!empty($idmedecin))&& 
                        (!empty($dateconsultation))&&
                        (!empty($symptome))&&
                        (!empty($diagnostic))
                        )
                        {
                        $sql="INSERT INTO consulter(idmala,idmed,symptome,diagnostic,dateconsultation)values(:idmala,:idmed, :symptome,:diagnostic,:dateconsultation)";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':idmala'=>$idmalade,
                                ':idmed'=>$idmedecin,
                                ':symptome'=>$symptome,
                                ':diagnostic'=>$diagnostic,
                                ':dateconsultation'=>$dateconsultation
                                ]
                            );
                            if($requete){?>
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
                <button type="submit" name="recherche">Recherche</button> -->
                <button type="submit" name="fac" class="im">Fiche de consultation</button>
        </form>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID consulter</th>
                        <th>Nom malade</th>
                        <th>Nom médecin</th>
                        <th>Date consultation</th>
                        <th>Symptomes</th>
                        <th>Diagnostic</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    $sql="SELECT consulter.idconsulter, malade.nomsmalade,medecin.nomsmed,consulter.dateconsultation,consulter.symptome,consulter.diagnostic FROM consulter, malade,medecin WHERE malade.idmala=consulter.idmala AND medecin.idmed=consulter.idmed";
                    $requete=$pdo->prepare($sql);
                    $requete->execute();
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idconsulter=$data['idconsulter'];
                        $nomsmalade=$data['nomsmalade'];
                        $nomsmed=$data['nomsmed'];
                        $dateconsultation=$data['dateconsultation'];
                        $symptome=$data['symptome'];
                        $diagnostic=$data['diagnostic'];
                        ?>
                        <td><?php echo $idconsulter?></td>
                        <td><?php echo $nomsmalade?></td>
                        <td><?php echo $nomsmed?></td>
                        <td><?php echo $dateconsultation?></td>
                        <td><?php echo $symptome?></td>
                        <td><?php echo $diagnostic?></td>
                        <td><a href="modifier_consult.php?id=<?php echo $idconsulter?>">modifier</a></td>
                        <td><a href="supprimer_consult.php?id=<?php echo $idconsulter?>">supprimer</a></td>
                        
                        </tr>
                        <?php   
                } 
                    ?>
                    
                </tbody>
            </table>
    </div>
    </main>
    <?php if(isset($_POST['fac'])){
        ?>
         <div class="facture">
            <form action="../etatSortie/fichemalade/pdf.php" method="post">
                 <h4> Imprimer une facture</h4>
                 <hr><br>
                 <label for="">Noms malade</label> <br>
                    <select name="idmalade">
                        <?php
                        $sql="SELECT DISTINCT malade.idmala, malade.nomsmalade FROM malade,consulter WHERE consulter.idmala=malade.idmala ";
                        $requete=$pdo->prepare($sql);
                        $requete->execute();
                        $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                        foreach($tab as $data){
                            $idmala=$data['idmala'];
                            $nomsmalade=$data['nomsmalade'];
                           
                        ?>
                        <option value="<?php echo $idmala?>"><?php echo $nomsmalade?></option>
                        <?php
                        }
                         ?>
                    </select> 
                   <button type="submit">IMPRIMER</button>
                 <a href="consulter.php">Annuler</a>
                  
            </form>
         </div>
        <?php
    }
    ?>
</body>
</html>