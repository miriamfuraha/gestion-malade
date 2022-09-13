<?php require 'header.php';
error_reporting(0);  
require "pdo.php";

$nommalade=$_POST['nommalade'];
$etatcivil=$_POST['etatcivil'];
$datedenaissance=$_POST['datedenaissance'];
$sexe=$_POST['sexe'];
$profession=$_POST['profession'];
$adresse=$_POST['adresse'];
$poids=$_POST['poids'];
$taille=$_POST['taille'];
$temperature=$_POST['temperature'];
$fr=$_POST['fr'];
$fc=$_POST['fc'];
$ta=$_POST['ta'];
$pouls=$_POST['pouls'];
$numerotelephone=$_POST['numerotelephone'];
$enregistrer=$_POST['enregistrer'];
$actualiser=$_POST['actualiser'];
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>ENREGISTREMENT MALADE</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms malade</label> <br>
                    <input type="text" name="nommalade" placeholder="nom postnom prenom">
                    </div>
                    <div class="item">
                    <label for="">Etat civil</label>
                    <select name="etatcivil" id="">
                        <option ></option>
                    <option value="celibataire">celibataire</option>
                    <option value="marie">marié</option>
                    <option value="Autre">Autres</option>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Date de naissance </label> <br>
                    <input type="date" name="datedenaissance">
                    </div>
                    <div class="item">
                    <label for="">Sexe </label>
                    <select name="sexe" id="">
                    <option value="M">M</option>
                    <option value="F">F</option>
                    <option value="Autre">Autres</option>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Profession</label> <br>
                    <input type="text" name="profession" placeholder="profession">
                    </div>
                    <div class="item">
                    <label for="">Adresse</label>
                    <input type="text" name="adresse" placeholder=" Quartier Avenu N°">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Poids</label> <br>
                    <input type="text" name="poids" placeholder="poids">
                    </div>
                    <div class="item">
                    <label for="">Taille</label>
                    <input type="text" name="taille" placeholder=" taille">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">T°</label> <br>
                    <input type="text" name="temperature" placeholder="température">
                    </div>
                    <div class="item">
                    <label for="">FR</label>
                    <input type="text" name="fr" placeholder="fréquence respiratoire">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">FC</label> <br>
                    <input type="text" name="fc" placeholder="fréquence cardiaque">
                    </div>
                    <div class="item">
                    <label for="">TA</label>
                    <input type="text" name="ta" placeholder="tension artérielle">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Pouls</label> <br>
                    <input type="text" name="pouls" placeholder="pulsation">
                    </div>
                    <div class="item">
                    <label for="">Numéro téléphone</label></br>
                    <input type="number" name="numerotelephone">
                    </div>
                </div>    
                <div class="btn">
                <button type="submit" name="enregistrer">Enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php
                    if(isset($enregistrer)){
                        if((!empty($nommalade)) &&
                        (!empty($etatcivil))&& 
                        (!empty($datedenaissance))&&
                        (!empty($sexe))&&
                        (!empty($profession))&& 
                        (!empty($adresse))&&
                        (!empty($poids))&& 
                        (!empty($taille))&& 
                        (!empty($temperature))&& 
                        (!empty($fr))&& 
                        (!empty($fc))&& 
                        (!empty($ta))&& 
                        (!empty($pouls))&&
                        (!empty($numerotelephone)) 
                        )
                        {
                        $sql="INSERT INTO  malade(nomsmalade,datenaissancemala,etatcivilmala,sexemala,professionmala,adresse,telmala,poidsmala,taillemala,tamala,frmala,fcmala,poulsmala,tmala)values(:nomsmalade, :datenaissancemala,:etatcivilmala,:sexemala,:professionmala,:adresse,:telmala,:poidsmala,:taillemala,:tamala,:frmala,:fcmala,:poulsmala,:tmala)";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':nomsmalade'=>$nommalade,
                                ':datenaissancemala'=>$datedenaissance,
                                ':etatcivilmala'=>$etatcivil,
                                ':sexemala'=>$sexe,
                                ':professionmala'=>$profession,
                                ':adresse'=>$adresse,
                                ':telmala'=>$numerotelephone,
                                ':poidsmala'=>$poids,
                                ':taillemala'=>$taille,
                                ':tamala'=>$ta,
                                ':frmala'=>$fr,
                                ':fcmala'=>$fc,
                                ':poulsmala'=>$pouls,
                                ':tmala'=>$temperature
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
                <input type="text" name="rech" placeholder="rechercher un malade">
                <button type="submit" name="recherche">Recherche</button>
                <a class="im" href="../etatSortie/liste_malade/pdf.php">lisite de malade</a>
        </form>
        <div class="table">
            <?php if(empty($_POST['rech'])){
                if(!isset($_POST['recherche'])){?>
            <table>
                <thead>
                <tr>
                        <th>ID malade</th>
                        <th>Noms malade</th>
                        <th>Etat civil</th>
                        <th>Date naissance</th>
                        <th>Sexe </th>
                        <th>Profession</th>
                        <th>Adresse</th>
                        <th>Poids</th>
                        <th>Taille</th>
                        <th>T°</th>
                        <th>FR</th>
                        <th>FC</th>
                        <th>TA</th>
                        <th>Pouls</th>
                        <th>Numéro téléphone</th>
                        <th>Modifier</th>
                        <th>supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                   <?php
                    $sql="SELECT * FROM malade where idmala=:id or nomsmalade like '%$rech%'";
                    $requete=$pdo->prepare($sql);
                    $requete->execute([':id'=>$rech]);
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    if(count($tab)==0){
                        header("location:malade.php");
                    }else
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
                        ?>
                        <td><?php echo $idmala?></td>
                        <td><?php echo $nommalade?></td>
                        <td><?php echo $etatcivil?></td>
                        <td><?php echo $datedenaissance?></td>
                        <td><?php echo $sexe?></td>
                        <td><?php echo $profession?></td>
                        <td><?php echo $adresse?></td>
                        <td><?php echo $poids?></td>
                        <td><?php echo $taille?></td>
                        <td><?php echo $temperature?></td>
                        <td><?php echo $fr?></td>
                        <td><?php echo $fc?></td>
                        <td><?php echo $ta?></td>
                        <td><?php echo $pouls?></td>
                        <td><?php echo $numerotelephone?></td>
                        <td><a href="modifier_malade.php?id=<?php echo $idmala?>">modifier</a></td>
                        <td><a href="supprimer_malade.php?id=<?php echo $idmala?>">supprimer</a></td>
                        
                        </tr>
                        <?php   
                }
                    ?>                    
                </tbody>
            </table>
            <?php } 
            }elseif(!empty($_POST['rech']) && isset($_POST['recherche'])) {
                $rech=$_POST['rech'];
                ?>
                <table>
                <thead>
                    <tr>
                        <th>ID malade</th>
                        <th>Noms malade</th>
                        <th>Etat civil</th>
                        <th>Date naissance</th>
                        <th>Sexe </th>
                        <th>Profession</th>
                        <th>Adresse</th>
                        <th>Poids</th>
                        <th>Taille</th>
                        <th>T°</th>
                        <th>FR</th>
                        <th>FC</th>
                        <th>TA</th>
                        <th>Pouls</th>
                        <th>Numéro téléphone</th>
                        <th>Modifier</th>
                        <th>supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                   <?php
                    $sql="SELECT * FROM malade where idmala=:id or nomsmalade like '%$rech%'";
                    $requete=$pdo->prepare($sql);
                    $requete->execute([':id'=>$rech]);
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    if(count($tab)==0){
                        header("location:malade.php");
                    }else
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
                        ?>
                        <td><?php echo $idmala?></td>
                        <td><?php echo $nommalade?></td>
                        <td><?php echo $etatcivil?></td>
                        <td><?php echo $datedenaissance?></td>
                        <td><?php echo $sexe?></td>
                        <td><?php echo $profession?></td>
                        <td><?php echo $adresse?></td>
                        <td><?php echo $poids?></td>
                        <td><?php echo $taille?></td>
                        <td><?php echo $temperature?></td>
                        <td><?php echo $fr?></td>
                        <td><?php echo $fc?></td>
                        <td><?php echo $ta?></td>
                        <td><?php echo $pouls?></td>
                        <td><?php echo $numerotelephone?></td>
                        <td><a href="modifier_malade.php?id=<?php echo $idmala?>">modifier</a></td>
                        <td><a href="supprimer_malade.php?id=<?php echo $idmala?>">supprimer</a></td>
                        
                        </tr>
                        <?php   
                }
                    ?>                    
                </tbody>
            </table>
                <?php
            }else{
                    header("location:malade.php");
            } ?>
            </div>
    </main>
</body>
</html>