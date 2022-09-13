<?php 
error_reporting(1);  
require "pdo.php";
$id=$_GET['id'];
$sql="SELECT * FROM medecin where idmed =:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
$tab=$requete->FetchAll(PDO::FETCH_ASSOC);
foreach($tab as $data){
    $idmed =$data['idmed'];
    $nommedecin=$data['nomsmed'];
    $sexe=$data['sexemed'];
    $numerotelephone=$data['phonemed'];
    $titre=$data['titremed'];
    $specialite=$data['specialitemed'];
}
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>MODIFIER MEDECIN</h3><hr>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms médecin</label> <br>
                    <input type="text" name="nommedecin" value="<?php echo $nommedecin?>">
                    </div>
                    <div class="item">
                    <label for="">Sexe </label>
                    <select name="sexe" value="<?php echo $sexe?>"id="">
                    <option value="M">M</option>
                    <option value="F">F</option>
                    <option value="Autre">Autres</option>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Numéro téléphone</label> <br>
                    <input type="number" name="numerotelephone"value="<?php echo $numerotelephone?>">
                    </div>
                    <div class="item">
                    <label for="">Titre</label>
                    <input type="text" name="titre" value="<?php echo $titre?>">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Spécialité</label> <br>
                    <input type="text" name="specialite" value="<?php echo $specialite?>">
                    </div>
                </div>    
                <div class="btn">
                <button type="submit" name="modifier">Modifier</button>
                <button type="submit" name="retour">Retour</button>
                <?php
              
                    $nommedecin=$_POST['nommedecin'];
                    $sexe=$_POST['sexe'];
                    $numerotelephone=$_POST['numerotelephone'];
                    $titre=$_POST['titre'];
                    $specialite=$_POST['specialite'];
                    $modifier=$_POST['modifier'];
                    $retour=$_POST['retour'];
                    if(isset($modifier)){
                        if((!empty($nommedecin)) &&
                        (!empty($sexe))&& 
                        (!empty($numerotelephone))&&
                        (!empty($titre))&&
                        (!empty($specialite)) 
                        )
                        {
                        $sql="UPDATE  medecin SET nomsmed=:nomsmed,sexemed=:sexemed,phonemed=:phonemed,titremed= :titremed,specialitemed=:specialitemed where idmed =:id";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':nomsmed'=>$nommedecin,
                                ':sexemed'=>$sexe,
                                ':phonemed'=>$numerotelephone,
                                ':titremed'=>$titre,
                                ':specialitemed'=>$specialite,
                                ':id'=>$id
                                ]
                            );
                            if($requete){?>
                            <script>
                                alert("modification reussi")
                            </script>
                                <?php
                            }

                        }else{?>
                            <script>
                                alert("champs laissé vide")
                            </script>
                            <?php
                        }
                    }elseif(isset($retour)){
                        header("location:medecin.php");
                    }
                ?>
                </div>
            </form>
    </div>
    
    </main>
</body>
</html>
<style>
    main{
        display:flex;
        align-items:center;
        justify-content:center;
    }
   .gauche{
       width:700px;
   }
   .gauche form{
    width: 100%;
    display: flex;
    justify-content: center;
    flex-direction: column;
    background:gray;
}
h3{
    color:white;
    text-decoration:underline white;
}
body main .gauche form .gp{
    width: 100%;
    display: flex;
    margin: 10px 0;
}
body main .gauche form .gp .item{
    width: 50%;
    
}
body main .gauche form .gp .item input,select{
    width: 96%;
    margin: 5px;
    padding: 5px 0;
}
body main .gauche form .gp .item label{
    margin: 5px;
    color:white;    
}
body main .gauche form .btn{
    margin-left: 5px;
    margin-bottom: 10px;
    width: 98%;

}
body main .gauche form .btn button{
    width: 100%;
    padding: 5px 0;
    font-size: 1em;
}
body main .gauche form .btn button:hover{
    background: green;
    transition: all 0.5s;
    color:white;
}
body main .droite{
    width: 57%;
    margin-left: 10px;
}
body main .droite form input{
    padding: 7px;
    width: 500px;
    border: 1px solid blue;
    border-radius: 6px 4px;
}
body main .droite form button{
    padding: 5px 15px;
    margin: 5px;
    display: inline-block;
    background:green;
    color: white;
    border: none;
}
</style>