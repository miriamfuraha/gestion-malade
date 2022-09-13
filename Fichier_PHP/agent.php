<?php require 'header.php';

error_reporting(0);  
require "pdo.php";

$noms=$_POST['noms'];
$sexe=$_POST['sexe'];
$numerotelephone=$_POST['numerotelephone'];
$service=$_POST['service'];
$enregistrer=$_POST['enregistrer'];
$actualiser=$_POST['actualiser'];
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>AGENT</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms agent</label> <br>
                    <input type="text" name="noms" placeholder="nom postnom prénom">
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
                    <label for="">Numéro téléphone</label> <br>
                    <input type="number" name="numerotelephone">
                    </div>
                    <div class="item">
                    <label for="">Service</label> <br>
                    <input type="text" name="service" placeholder="service">
                    </div>
                </div>                      
                <div class="btn">
                <button type="submit" name="enregistrer">Enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php
                    if(isset($enregistrer)){
                        if((!empty($noms)) &&
                        (!empty($sexe))&& 
                        (!empty($numerotelephone))&&
                        (!empty($service)) 
                        )
                        {
                        $sql="INSERT INTO   agent(nomsagent,sexeag,phoneag,serviceag)values(:nomsagent, :sexeag,:phoneag,:serviceag)";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':nomsagent'=>$noms,
                                ':sexeag'=>$sexe,
                                ':phoneag'=>$numerotelephone,
                                ':serviceag'=>$service
        
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
            </form>
    </div>
    <div class="droite">
        <form action="" method="post">
                <!-- <input type="text" name="recherche" placeholder="rechercher un malade"> -->
                <!-- <button type="submit" name="recherche">Recherche</button> -->
                <!-- <a class="im" href="etudiantPDF/pdf.php">imprimer</a> -->
        </form>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID agent</th>
                        <th>Noms</th>
                        <th>Sexe</th>
                        <th>Numéro téléphone</th>
                        <th>Service</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                    $sql="SELECT * FROM agent";
                    $requete=$pdo->prepare($sql);
                    $requete->execute();
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idag=$data['idag'];
                        $nomsagent=$data['nomsagent'];
                        $sexeag=$data['sexeag'];
                        $phoneag=$data['phoneag'];
                        $serviceag=$data['serviceag'];
                        ?>
                        <td><?php echo $idag?></td>
                        <td><?php echo $nomsagent?></td>
                        <td><?php echo $sexeag?></td>
                        <td><?php echo $phoneag?></td>
                        <td><?php echo $serviceag?></td>
                        <td><a href="modifier_agent.php?id=<?php echo $idag?>">modifier</a></td>
                        <td><a href="supprimer_agent.php?id=<?php echo $idag?>">supprimer</a></td>
                        
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