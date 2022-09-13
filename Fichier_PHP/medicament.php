<?php require 'header.php';
error_reporting(0);
require "pdo.php";

$designation=$_POST['designation'];
$prixunitaire=$_POST['prixunitaire'];
$dateexpiration=$_POST['dateexpiration'];
$enregistrer=$_POST['enregistrer'];
$actualiser=$_POST['actualiser'];
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>Médicament</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Désignation</label> <br>
                    <input type="text" name="designation" placeholder="désignation">
                    </div>
                    <div class="item">
                    <label for="">Prix unitaire</label>
                    <input type="text" name="prixunitaire" placeholder="prix unitaire">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Date d'expiration</label> <br>
                    <input type="date" name="dateexpiration" placeholder="date d'expiration">
                    </div>
                </div>                      
                <div class="btn">
                <button type="submit" name="enregistrer">Enregistrer</button>
                <button type="submit" name="actualiser">Actualiser</button>
                <?php
                
                if(isset($enregistrer)){
                    if((!empty($designation))&&
                        (!empty($prixunitaire))&&
                        (!empty($dateexpiration))
                    )
                    {
                        $sql="INSERT INTO medicament(designationmedi,pumedi,dateexpimedi) value(:designationmedi,:pumedi,:dateexpimedi)";
                        $requete=$pdo->prepare($sql);
                        $requete->execute([
                            ':designationmedi'=>$designation,
                            ':pumedi'=>$prixunitaire,
                            ':dateexpimedi'=>$dateexpiration
                        ]);
                        if($requete){?>
                        <script>
                            alert("Enregistrment réussi ")
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
                        <th>ID médicament</th>
                        <th>Désignation</th>
                        <th>Prix unitaire</th>
                        <th>Date d'expiration</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                     <?php
                    $sql="SELECT * FROM  medicament";
                    $requete=$pdo->prepare($sql);
                    $requete->execute();
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idmedi=$data['idmedi'];
                        $designation=$data['designationmedi'];
                        $prixunitaire=$data['pumedi'];
                        $dateexpiration=$data['dateexpimedi'];
                        ?>
                        <td><?php echo $idmedi?></td>
                        <td><?php echo $designation?></td>
                        <td><?php echo $prixunitaire?></td>
                        <td><?php echo $dateexpiration?></td>
                        <td><a href="modifier_medicament.php?id=<?php echo $idmedi?>">modifier</a></td>
                        <td><a href="supprimer_medicament.php?id=<?php echo $idmedi?>">supprimer</a></td>
                        
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