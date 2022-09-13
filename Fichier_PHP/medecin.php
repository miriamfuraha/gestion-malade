<?php require 'header.php';
error_reporting(1);  
require "pdo.php";

$nommedecin=$_POST['nommedecin'];
$sexe=$_POST['sexe'];
$numerotelephone=$_POST['numerotelephone'];
$titre=$_POST['titre'];
$specialite=$_POST['specialite'];
$enregistrer=$_POST['enregistrer'];
$actualiser=$_POST['actualiser'];
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>MEDECIN</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms médecin</label> <br>
                    <input type="text" name="nommedecin" placeholder="nom postnom prenom">
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
                    <label for="">Titre</label>
                    <input type="text" name="titre" placeholder=" titre du médecin">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Spécialité</label> <br>
                    <input type="text" name="specialite" placeholder="spécialité du médecin">
                    </div>
                </div>    
                <div class="btn">
                <button type="submit" name="enregistrer">Enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php
                    if(isset($enregistrer)){
                        if((!empty($nommedecin)) &&
                        (!empty($sexe))&& 
                        (!empty($numerotelephone))&&
                        (!empty($titre))&&
                        (!empty($specialite)) 
                        )
                        {
                        $sql="INSERT INTO   medecin(nomsmed,sexemed,phonemed,titremed,specialitemed)values(:nomsmed, :sexemed,:phonemed,:titremed,:specialitemed)";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':nomsmed'=>$nommedecin,
                                ':sexemed'=>$sexe,
                                ':phonemed'=>$numerotelephone,
                                ':titremed'=>$titre,
                                ':specialitemed'=>$specialite
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
                <a class="im" href="../etatSortie/listeMedecin/pdf.php">imprimer</a>
        </form>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Id Médecin</th>
                        <th>Noms</th>
                        <th>Sexe</th>
                        <th>Numéro téléphone</th>
                        <th>Titre</td>
                        <th>Spécialité</th>
                        <th>modifier</th>
                        <th>supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                    $sql="SELECT * FROM medecin";
                    $requete=$pdo->prepare($sql);
                    $requete->execute();
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idmed =$data['idmed'];
                        $nommedecin=$data['nomsmed'];
                        $sexe=$data['sexemed'];
                        $numerotelephone=$data['phonemed'];
                        $titre=$data['titremed'];
                        $specialite=$data['specialitemed'];
                    
                        ?>  
                        <td><?php echo $idmed?></td>
                        <td><?php echo $nommedecin?></td>
                        <td><?php echo $sexe?></td>
                        <td><?php echo $numerotelephone?></td>
                        <td><?php echo $titre?></td>
                        <td><?php echo $specialite?></td>
                        <td><a href="modifier_medecin.php?id=<?php echo $idmed?>">modifier</a></td>
                        <td><a href="supprimer_medecin.php?id=<?php echo $idmed?>">supprimer</a></td>
                        
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