<?php 
error_reporting(1);  
require "pdo.php";
$id=$_GET['id'];
$sql="SELECT * FROM paiement where idpaiement =:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
$tab=$requete->FetchAll(PDO::FETCH_ASSOC);
foreach($tab as $data){
    $idpaiement=$data['idpaiement'];
    $idmala =$data['idmala'];
    $idag =$data['idag'];
    $montant=$data['montant'];
    $motif=$data['motif'];
    $datepaiement=$data['datepaiement'];
}
    ?>
    <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>PAIEMENT</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms malade</label> <br>
                    <select name="idmalade">
                        <option value="<?php echo $idmala?>"><?php echo $idmala?></option>
                    </select> 
                    </div>
                    <div class="item">
                    <label for="">Noms agent</label> <br>
                    <select name="idag">
                    <option value="<?php echo $idag ?>"><?php echo $idag?></option>
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
                    <input type="text" name="montant" value="<?php echo $montant?>">
                    </div>
                    <div class="item">
                    <label for="">Motif</label>
                    <input type="text" name="motif" value="<?php echo $motif?>">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Date paiement</label> <br>
                    <input type="text" value="<?php echo $datepaiement?>" name="datepaiement"> 
                    </div>
                </div>    
                <div class="btn">
                <button type="submit" name="modifier">Modifier</button>
                <button type="submit" name="retour">Retour</button>
                <?php
                $idmalade=$_POST['idmalade'];
                $idag =$_POST['idag'];
                $montant=$_POST['montant'];
                $motif=$_POST['motif'];
                $datepaiement=$_POST['datepaiement'];
                $modifier=$_POST['modifier'];
                $retour=$_POST['retour'];
                if(isset($modifier)){
                    if((!empty($idmalade)) &&
                    (!empty($idag))&& 
                    (!empty($montant))&&
                    (!empty($motif))&&
                    (!empty($datepaiement)) 
                    )
                    {
                        $sql="UPDATE paiement SET idmala =:idmala,idag =:idag ,montant=:montant,motif=:motif,datepaiement=:datepaiement where idpaiement=:id";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':idmala'=>$idmalade,
                                ':idag'=>$idag,
                                ':montant'=>$montant,
                                ':motif'=>$motif,
                                ':datepaiement'=>$datepaiement,
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
                        header("location:paiement.php");
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