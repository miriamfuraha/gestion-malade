<?php require 'header.php' ?>

<?php
error_reporting(1);  
 
require "pdo.php";
$designation=$_POST['designation'];
$categorie=$_POST['categorie'];
$prix=$_POST['prix'];
$enregistrer=$_POST['enregistrer'];
$actualiser=$_POST['actualiser'];
?>

    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>CHAMBRE</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Désignation</label> <br>
                    <input type="text" name="designation" placeholder="désignation">
                    </div>
                    <div class="item">
                    <label for="">Catégorie</label>
                    <input type="text" name="categorie" placeholder="catégorie">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Prix</label> <br>
                    <input type="text" name="prix" placeholder="prix de la chambre">
                    </div>
                </div>
                <div class="btn">
                <button type="submit" name="enregistrer">enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php
                    if (isset($enregistrer)) {
                        if ((!empty($designation))&& 
                            (!empty($categorie))&&
                            (!empty($prix))
                            ) 
                            {
                            $sql="INSERT INTO chambre(designationchambre,prixchambre,categoriechambre) values (:designationchambre,:prixchambre,:categoriechambre)";
                            $requette=$pdo->prepare($sql);
                            $requette->execute([
                                ':designationchambre'=> $designation,
                                ':prixchambre'=> $prix,
                                ':categoriechambre'=>$categorie
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
                        <th>ID chambre</th>
                        <th>Désignation</th>
                        <th>catégorie</th>
                        <th>Prix</th>

                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                     <?php
                    $sql="SELECT * FROM chambre";
                    $requete=$pdo->prepare($sql);
                    $requete->execute();
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idchambre=$data['idchambre'];
                        $designationchambre=$data['designationchambre'];
                        $prixchambre=$data['prixchambre'];
                        $categoriechambre=$data['categoriechambre'];
                     
                        ?>  
                        <td><?php echo $idchambre?></td>
                        <td><?php echo $designationchambre?></td>
                        <td><?php echo $categoriechambre?></td>
                        <td><?php echo $prixchambre?></td>
                        <td><a href="modifier_chambre.php?id=<?php echo $idchambre?>">modifier</a></td>
                        <td><a href="supprimer_chambre.php?id=<?php echo $idchambre?>">supprimer</a></td>
                        
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