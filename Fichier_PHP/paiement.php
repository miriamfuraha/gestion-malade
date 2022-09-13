
<?php require 'header.php';
require "pdo.php";
error_reporting(0);

$idmalade=$_POST['idmalade'];
$idag =$_POST['idag'];
$montant=$_POST['montant'];
$motif=$_POST['motif'];
$datepaiement=$_POST['datepaiement'];
$enregistrer=$_POST['enregistrer'];
$actualiser=$_POST['actualiser'];
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>PAIEMENT</h3><hr></br>
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
                    <label for="">Noms agent</label> <br>
                    <select name="idag ">
                        <?php
                        $sql="SELECT idag , nomsagent FROM agent";
                        $requete=$pdo->prepare($sql);
                        $requete->execute();
                        $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                        foreach($tab as $data){
                            $idag=$data['idag'];
                            $nomsagent=$data['nomsagent'];
                           
                        ?>
                        <option value="<?php echo $idag ?>"><?php echo $idag. " ".$nomsagent?></option>
                        <?php
                        }
                         ?>
                    </select> 
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Montant</label> <br>
                    <input type="text" name="montant">
                    </div>
                    <div class="item">
                    <label for="">Motif</label>
                    <input type="text" name="motif" placeholder="motif">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Date paiement</label> <br>
                    <input type="date" name="datepaiement">
                    </div>
                </div>    
                <div class="btn">
                <button type="submit" name="enregistrer">Enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php
                    if(isset($enregistrer)){
                        if((!empty($idmalade)) &&
                        (!empty($idag))&& 
                        (!empty($montant))&&
                        (!empty($motif))&&
                        (!empty($datepaiement)) 
                        )
                        {
                        $sql="INSERT INTO   paiement(idmala,idag,montant,motif,datepaiement)values(:idmala, :idag,:montant,:motif,:datepaiement)";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':idmala'=>$idmalade,
                                ':idag'=>$idag,
                                ':montant'=>$montant,
                                ':motif'=>$motif,
                                ':datepaiement'=>$datepaiement
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
                <button type="submit" name="fac" class="im">facture</button>
                <button type="submit" name="res" class="im">Recu de paiement</button>
        </form>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID paiement</th>
                        <th>Noms malade</th>
                        <th>Noms agent</th>
                        <th>Montant</th>
                        <th>Motif</th>
                        <th>Date paiement </th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                     <?php
                    $sql="SELECT paiement.idpaiement, malade.nomsmalade,agent.nomsagent,paiement.montant,paiement.motif,paiement.datepaiement FROM paiement, malade,agent WHERE malade.idmala=paiement.idmala AND agent.idag =paiement.idag";
                    $requete=$pdo->prepare($sql);
                    $requete->execute();
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idpaiement=$data['idpaiement'];
                        $idmalade=$data['nomsmalade'];
                        $idagent=$data['nomsagent'];
                        $montant=$data['montant'];
                        $motif=$data['motif'];
                        $date=$data['datepaiement'];
                        ?>
                        <td><?php echo $idpaiement?></td>
                        <td><?php echo $idmalade?></td>
                        <td><?php echo $idagent?></td>
                        <td><?php echo $montant?></td>
                        <td><?php echo $motif?></td>
                        <td><?php echo $date?></td>
                        <td><a href="modifier_paiement.php?id=<?php echo $idpaiement?>">modifier</a></td>
                        <td><a href="supprimer_paiement.php?id=<?php echo $idpaiement?>">supprimer</a></td>
                        
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
            <form action="../etatSortie/facture/pdf.php" method="post">
                 <h4> Imprimer une facture</h4>
                 <hr><br>
                 <label for="">Noms malade</label> <br>
                    <select name="idmalade">
                        <?php
                        $sql="SELECT DISTINCT malade.idmala, malade.nomsmalade FROM malade,consommer WHERE consommer.idmala=malade.idmala ";
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
                 <a href="paiement.php">Annuler</a>
                  
            </form>
         </div>
        <?php
    }elseif(isset($_POST['res'])){
        ?>
<div class="facture">
            <form action="../etatSortie/recu/pdf.php" method="post">
                 <h4> Imprimer un recu de paiement</h4>
                 <hr><br>
                 <label for="">Noms malade</label> <br>
                    <select name="idmalade">
                        <?php
                        $sql="SELECT DISTINCT malade.idmala, malade.nomsmalade FROM malade,paiement WHERE paiement.idmala=malade.idmala ";
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
                 <a href="paiement.php">Annuler</a>
                  
            </form>
         </div>

        <?php
    }
    ?>

</body>
</html>