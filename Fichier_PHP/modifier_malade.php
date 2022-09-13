<?php 
error_reporting(1);  
require "pdo.php";
$id=$_GET['id'];
$sql="SELECT * FROM malade where idmala=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
$tab=$requete->FetchAll(PDO::FETCH_ASSOC);
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
}
?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>MODIFIER MALADE</h3><hr>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms malade</label> <br>
                    <input type="text" name="nommalade" value="<?php echo $nommalade?>">
                    </div>
                    <div class="item">
                    <label for="">Etat civil</label>
                    <select name="etatcivil" id="">
                        <option value="<?php echo $etatcivil?>"></option>
                    <option value="celibataire">celibataire</option>
                    <option value="marié">marié</option>
                    <option value="Autre">Autres</option>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Date de naissance </label> <br>
                    <input type="text" name="datedenaissance" value="<?php echo $datedenaissance?>" >
                    </div>
                    <div class="item">
                    <label for="">Sexe </label>
                    <select name="sexe" value="<?php echo $sexe?>" id="">
                    <option value="M">M</option>
                    <option value="F">F</option>
                    <option value="Autre">Autres</option>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Profession</label> <br>
                    <input type="text" name="profession" value="<?php echo $profession?>">
                    </div>
                    <div class="item">
                    <label for="">Adresse</label>
                    <input type="text" name="adresse" value="<?php echo $adresse?>">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Poids</label> <br>
                    <input type="text" name="poids" value="<?php echo $poids?>">
                    </div>
                    <div class="item">
                    <label for="">Taille</label>
                    <input type="text" name="taille" value="<?php echo $taille?>">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">T°</label> <br>
                    <input type="text" name="temperature" value="<?php echo $temperature?>">
                    </div>
                    <div class="item">
                    <label for="">FR</label>
                    <input type="text" name="fr" value="<?php echo $fr?>">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">FC</label> <br>
                    <input type="text" name="fc" value="<?php echo $fc?>">
                    </div>
                    <div class="item">
                    <label for="">TA</label>
                    <input type="text" name="ta" value="<?php echo $ta?>">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Pouls</label> <br>
                    <input type="text" name="pouls" value="<?php echo $pouls?>">
                    </div>
                    <div class="item">
                    <label for="">Numéro téléphone</label></br>
                    <input type="number" name="numerotelephone"  value="<?php echo $numerotelephone?>">
                    </div>
                </div>    
                <div class="btn">
                <button type="submit" name="modifier">modifier</button>
                <button type="submit" name="actualiser">retour</button>
                <?php
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
                $modifier=$_POST['modifier'];
                $actualiser=$_POST['actualiser'];
                    if(isset($modifier)){
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
                        $sql="UPDATE malade SET nomsmalade=:nomsmalade ,datenaissancemala=:datenaissancemala,etatcivilmala=:etatcivilmala,sexemala= :sexemala,professionmala=:professionmala,adresse=:adresse,telmala=:telmala,poidsmala=:poidsmala,taillemala=:taillemala,tamala=:tamala,frmala=:frmala,fcmala=:fcmala,poulsmala=:poulsmala,tmala=:tmala where idmala=:id";
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
                                ':tmala'=>$temperature,
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
                    }elseif(isset($actualiser)){
                        header("location:malade.php");
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