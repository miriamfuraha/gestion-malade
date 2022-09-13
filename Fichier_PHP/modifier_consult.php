<?php
error_reporting(1);  
require "pdo.php";
$id=$_GET['id'];
$sql="SELECT * FROM consulter where idconsulter=:id";
                    $requete=$pdo->prepare($sql);
                    $requete->execute([
                        ':id'=>$id
                    ]);
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idconsulter=$data['idconsulter'];
                        $idmala=$data['idmala'];
                        $idmed=$data['idmed'];
                        $dateconsultation=$data['dateconsultation'];
                        $symptome=$data['symptome'];
                        $diagnostic=$data['diagnostic'];
                    }
?>
 <main>
    <div class="gauche">
            <form action="" method="post">
                <h3>CONSULTATION</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms malade</label> <br>
                    <select name="idmalade">
                        <option value="<?php echo $idmala?>"><?php echo $idmala?></option>
                    </select>
                    </div>
                    <div class="item">
                    <label for="">Noms médecin</label>
                    <select name="idmedecin">
                    <option value="<?php echo $idmed?>"><?php echo $idmed?></option>
                    <?php
                        $sql="SELECT idmed ,nomsmed FROM medecin";
                        $requete=$pdo->prepare($sql);
                        $requete->execute();
                        $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                        foreach($tab as $data){
                            $idmed=$data['idmed'];
                            $nomsmed=$data['nomsmed'];
                           
                        ?>
                        <option value="<?php echo $idmed?>"><?php echo $idmed . " ".$nomsmed?></option>
                        <?php
                        }
                         ?>
                    </select>
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Date Consultation</label> <br>
                    <input type="date" name="dateconsultation" value="<?php echo $dateconsultation?>">
                    </div>
                </div>
                <div class="gp">
                    <div class="iteme">
                    <label for="">Symptomes</label> <br>
                    <input type="text" name="symptome" value="<?php echo $symptome?>">
                    </div>
                    <div class="iteme">
                    <label for="">Diagnostic</label></br>
                    <input type="text" name="diagnostic" value="<?php echo $diagnostic?>">
                    </div>
                </div>                       
                <div class="btn">
                <button type="submit" name="modifier">Modifier</button>
                <button type="submit" name="retour">Retour</button>
                <?php
                $idmalade=$_POST['idmalade'];
                $idmedecin=$_POST['idmedecin'];
                $dateconsultation=$_POST['dateconsultation'];
                $symptome=$_POST['symptome'];
                $diagnostic=$_POST['diagnostic'];
                $modifier=$_POST['modifier'];
                $retour=$_POST['retour'];
                if(isset($modifier)){
                    if((!empty($idmalade)) &&
                    (!empty($idmedecin))&& 
                    (!empty($dateconsultation))&&
                    (!empty($symptome))&&
                    (!empty($diagnostic))
                    )
                    {
                        $sql="UPDATE consulter SET idmala=:idmala,idmed=:idmed,symptome=:symptome,diagnostic= :diagnostic,dateconsultation=:dateconsultation where idconsulter=:id";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':idmala'=>$idmalade,
                                ':idmed'=>$idmedecin,
                                ':symptome'=>$symptome,
                                ':diagnostic'=>$diagnostic,
                                ':dateconsultation'=>$dateconsultation,
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
                        header("location:consulter.php");
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
.iteme input{
    height:80px;
    margin: 20px;
}
</style>