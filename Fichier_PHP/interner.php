<?php require 'header.php';
error_reporting(0);
require "pdo.php";
$enregistrer= $_POST['enregistrer'];
$actualiser= $_POST['actualiser'];
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>INTERNER</h3><hr></br>
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
                    <label for="">Désignation chambre</label> <br>
                    <select name="idchambre">
                        <?php
                        $sql="SELECT idchambre, designationchambre FROM chambre";
                        $requete=$pdo->prepare($sql);
                        $requete->execute();
                        $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                        foreach($tab as $data){
                            $idchambre=$data['idchambre'];
                            $designationchambre=$data['designationchambre'];
                           
                        ?>
                        <option value="<?php echo $idchambre?>"><?php echo $idchambre . " ".$designationchambre?></option>
                        <?php
                        }
                         ?>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Date entrée</label> <br>
                    <input type="date" name="dateentree">
                    </div>
                    <div class="item">
                    <label for="">Date sortie</label> <br>
                    <input type="date" name="datesortie">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Service</label> <br>
                    <input type="text" name="services" placeholder="service">
                    </div>
                    <div class="item">
                    <label for="">Statut</label>
                    <input type="text" name="statut">
                    </div>
                </div>
                <div class="btn">
                <button type="submit" name="enregistrer">Enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php
                $idmalade=$_POST['idmalade'];
                $idchambre=$_POST['idchambre'];
                $dateentree=$_POST['dateentree'];
                $datesortie=$_POST['datesortie'];
                $statut= $_POST['statut'];
                $services= $_POST['services']; 
                if (isset($enregistrer)){
                    if((!empty($idmalade))&& 
                       (!empty($idchambre))&&
                       (!empty($dateentree))&& 
                       (!empty($datesortie))&&
                       (!empty($statut))&&
                       (!empty($services))
                      )  
                       {
                        $sql="INSERT INTO  interner(idmala,idchambre,
                        services,statut,dateentree,datesortie) values (:idmala,
                        :idchambre,:services,:statut,
                        :dateentree,:datesortie)";

                            $requette=$pdo->prepare($sql);
                            $requette->execute([
                                ':idmala'=> $idmalade,
                                ':idchambre'=>$idchambre,
                                ':services'=>$services,
                                ':statut'=>$statut,
                                ':dateentree'=>$dateentree,
                                ':datesortie'=>$datesortie,

                            ]);
                            if($requette){?>
                                <script>
                                    alert("enregistrement réussi")
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
                        <th>ID interner</th>
                        <th>Noms malade</th>
                        <th>Désignation chambre</th>
                        <th>Date entrée</th>
                        <th>Date sortie</th>
                        <th>Service</th>
                        <th>Statut</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                    $sql=$sql="SELECT interner.idinterner, malade.nomsmalade,chambre.designationchambre,interner.services,interner.statut,interner.dateentree,interner.datesortie FROM interner, malade,chambre WHERE malade.idmala=interner.idmala AND chambre.idchambre=interner.idchambre";
                    $requete=$pdo->prepare($sql);
                    $requete->execute();
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idinterner =$data['idinterner'];
                        $nomsmalade=$data['nomsmalade'];
                        $designationchambre=$data['designationchambre'];
                        $services=$data['services'];
                        $dateentree=$data['dateentree'];
                        $datesortie=$data['datesortie'];
                        $statut=$data['statut'];
                  
                        ?>
                        <td><?php echo $idinterner?></td>
                        <td><?php echo $nomsmalade?></td>
                        <td><?php echo $designationchambre?></td>
                        <td><?php echo $dateentree?></td>
                        <td><?php echo $datesortie?></td>
                        <td><?php echo $services?></td>
                        <td><?php echo $statut?></td>
                        <td><a href="modifier_interner.php?id=<?php echo $idinterner?>">modifier</a></td>
                        <td><a href="supprimer_interner.php?id=<?php echo $idinterner?>">supprimer</a></td>
                        
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